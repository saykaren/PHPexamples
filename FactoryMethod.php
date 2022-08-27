<?php

class DataService
{
    public function get(int $datasetId): array
    {
        // method body
    }

    public function set(array $data): int
    {
        //method body
    }
}

class DataController
{
    private DataService $dataService;

    private TextProcessorFactoryInterface $factory;

    public function __construct(
        DataService $dataService,
        TextProcessorFactoryInterface $factory
    )
    {
        $this->dataService = $dataService;
        $this->factory = $factory;
    }

    public function get(Request $request, int $datasetId): Response
    {
        $data = $this->dataService->get($datasetId);
        $format = $request->header('Accept');
        $factory = $this->factory->make($format);

        // if ($format === 'text/xml') {
        //     $output = (new XmlProcessor)->write($data);
        // } else {
        //     $format = 'application/json';
        //     $output = (new JsonProcessor)->write($data);
        // }

        return new Response(
            $factory->write($data),
            ['Content-Type' => $format]
        );
    }

    public function set(Request $request): Response
    {
        $format = $request->header('Content-Type');

        if ($format === 'text/xml') {
            $data = (new XmlProcessor)->read($request->body);
        } else {
            $data = json_decode($request->body);
        }

        $id = $this->dataService->set($data);

        return new Response(
            '',
            ['Location' => '/api/dataset/' . $id]
        );
    }
}

class XmlProcessor
{
    public function read(string $xml): array
    {
        // method body
    }

    public function write(array $data): string
    {

    }
}

interface TextProcessor
{
    public function read(string $content): array;

    public function write(array $data): string;
}

class JsonProcessor implements TextProcessor
{
    public function read(string $content): array
    {
        return json_decode($content);
    }

    public function write(array $data): string
    {
        return json_encode($content);
    }
}

interface TextProcessorFactoryInterface
{
    public function make(string $mediaType): TextProcessorFactoryInterface;
}

class TextProcessorFactory implements TextProcessorFactoryInterface
{
    protected array $factories = [
        'text/xml'  => XmlProcessor::class,
        'text/csv'  => CsvProcessor::class,
        'application/yaml'  => YamlProcessor::class,
        'application/json'  => JsonProcessor::class
    ];

    protected string $default = JsonProcessor::class;

    public function make(string $mediaType): TextProcessorFactoryInterface
    {
        $processor = $this->factories[$mediaType] ?? $this->default;

        if ($processor) {
            return new $processor;
        }

        throw new InvalidArgumentException(
            sprintf('No factory for %s', $mediaType)
        );
    }
}

class Response
{
    public static function make(
        string $body = '',
        $statusCode = 200,
        $headers = []
    ): Response
    {
    }

    public static function get(Request $request, int $datasetId): Response
    {
        $data = $this->dataService->get($datasetId);
        $format = $request->header('Accept');
        $factory = $this->factory->make($format);
        
        return Response::make(
            $factory->write($data),
            200,
            ['Content-Type' => $format]
        );
    }
}

///https://www.youtube.com/watch?v=QnvfoCfFi7A&list=PLTjq-_B36DnAmm4yopr9mzOh1cQEAlBs3 6:05