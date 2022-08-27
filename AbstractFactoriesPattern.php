<?php

abstract class Heading implements Block
{
    protected string $body;
    protected int $level;

    public function __construct(string $body, int $level=null)
    {
        $this->body = $body;
        $this->level = $level;
    }
}

class HTMLHeading extends Heading
{
    public function getOutput(): string
    {
        return '<h' . $this->level . '>'
            . $this->body
            . '</h' . $this->level . '>';
    }
}

abstract class Paragraph implements Block
{
    protected string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }
}

class HTMLParagraph extends Paragraph
{
    public function getOutput(): string
    {
        return '<p>' . $this->body . '</p';
    }
}

class HTMLBlockFactory extends BaseBlockFactory
{

    public function makeHeading(array $data): Heading
    {
        $this->validateHeading($data);

        return new HTMLHeading($data['body'], $data['level'] ?? null);
    }

    public function makeParagraph(array $data): Paragraph
    {
        $this->validateParagraph($data);

        return new HTMLParagraph($data['body'] ?? null);
    }
}

class MarkDownHeading extends Heading
{
    public function getOutput(): string
    {
        return str_repeat('#', $this->level)
            . $this->body
            . PHP_EOL;
    }
}

class MarkDownParagraph extends Paragraph
{
    public function getOutput(): string
    {
        return PHP_EOL
            . str_replace("\n", '', $this->body)
            . PHP_EOL . PHP_EOL;
    }
}

class MarkDownBlockFactory extends BaseBlockFactory
{

    public function makeHeading(array $data): Heading
    {
        $this->validateHeading($data);

        return new MarkDownHeading($data['body'], $data['level'] ?? null);
    }

    public function makeParagraph(array $data): Heading
    {
        $this->validateParagraph($data);

        return new MarkDownHeading($data['body'] ?? null);
    }
}

abstract class BaseBlockFactory implements BlockFactory
{
    protected function validateHeading(array $data): void
    {
        if (!isset($data['body'])) {
            throw Exception('Heading must have a body');
        }
    }

    protected function validateParagraph(array $data): void
    {
        if (!isset($data['body'])) {
            throw Exception('Paragraph must have a body');
        }
    }
}


interface Block 
{
    public function getOutput(): string
    {
        // todo
    }

}

class Factory 
{

    public function outputContent(array $content, string $format): string
    {
        $output = '';
        $factory = match($format) {
            'html' => new HTMLBlockFactory(),
            'markdown' => new MarkDownBlockFactory()
        };


        foreach ($content as $item) {
            $block = null;

            switch ($item['type']) {
                case 'heading':
                    if (!isset($item['data']['body'])) {
                        throw Exception('Headers must have a body');
                    }
                    $block = $factory->makeHeading($item['data']);
                    break;  
                case 'paragraph':
                    if (!isset($item['data']['body'])) {
                        throw Exception('Paragraph must have a body');
                    }
                    $block = $factory->makeParagraph($item['data']);
                    break;
                default:
                    break;

            }

            if ($item['type'] === 'heading') {
            
            } else if ($item['type'] === 'paragraph') {
                
            }

            if ($block !== null) {
                $output .= $block->getOutput();
            }
        }

        return $output;
    }

    public function makeHeading(array $item): Heading
    {
        if (!isset($item['data']['body'])) {
            throw Exception('Heading must have a body');
        }

        return new Heading($item['data']['body'], $item['data']['level'] ?? null);
    }
    protected $data = [
        [
            'type' => 'heading',
            'data' => [
                'level' => 1,
                'body' => 'I am a heading'
            ]
        ],
        [
            'type' => 'heading',
            'data' => [
                'body' => 'I am a paragraph'
            ]
        ],
        [
            'type' => 'heading',
            'data' => [
                'body' => 'I am a paragraph'
            ]
        ]
    ];

}