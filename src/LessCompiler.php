<?php

namespace LessCompiler;

use Less_Parser;
use Phulp\PipeInterface;
use Phulp\Source;

class LessCompiler implements PipeInterface
{
    /**
     * @var string $uri
     */
    private $uri;

    /**
     * @param string $uri
     */
    public function __construct($uri = null)
    {
        $this->uri = $uri;
    }

    /**
     * @inheritdoc
     */
    public function execute(Source $src)
    {
        foreach ($src->getDistFiles() as $key => $file) {
            if (preg_match('/\.less$/', $file->getName()) || preg_match('/\.less$/', $file->getDistpathname())) {
                $parser = new Less_Parser();
                $parser->parseFile($file->getFullpath() . DIRECTORY_SEPARATOR . $file->getName(), $this->uri);
                $css = $parser->getCss();

                $file->setContent($css);
                $file->setDistpathname(preg_replace('/less$/', 'css', $file->getDistpathname()));
            }
        }
    }
}
