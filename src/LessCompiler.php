<?php

namespace Phulp\LessCompiler;

use Less_Parser;
use Phulp\PipeInterface;
use Phulp\Source;

class LessCompiler implements PipeInterface
{
    /**
     * @var array $options
     */
    private $options = [
        'uri' => null,
    ];

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @inheritdoc
     */
    public function execute(Source $src)
    {
        foreach ($src->getDistFiles() as $key => $file) {
            if (preg_match('/\.less$/', $file->getName()) || preg_match('/\.less$/', $file->getDistpathname())) {
                $parser = new Less_Parser();
                $parser->parseFile(
                    $file->getFullpath() . DIRECTORY_SEPARATOR . $file->getName(),
                    $this->options['uri']
                );
                $css = $parser->getCss();

                $file->setContent($css);
                $file->setDistpathname(preg_replace('/less$/', 'css', $file->getDistpathname()));
            }
        }
    }
}
