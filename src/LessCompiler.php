<?php

namespace LessCompiler;

use Less_Parser;
use Phulp\PipeInterface;
use Phulp\Source;

class LessCompiler extends PipeInterface
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
            $parser = new Less_Parser();
            $parser->parse($file->getContent(), $this->uri);
            $css = $parser->getCss();

            $file->setContent($css);
            $file->setName(preg_replace('/less$/', 'css', $file->getName()));
        }
    }
}
