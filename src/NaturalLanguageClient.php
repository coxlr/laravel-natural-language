<?php

namespace Coxlr\NaturalLanguage;

use Exception;
use Google\Cloud\Language\Annotation;
use Google\Cloud\Language\LanguageClient;

class NaturalLanguageClient
{
    private LanguageClient $language;

    public function __construct(array $config)
    {
        $this->checkForInvalidConfiguration($config);

        $this->language = new LanguageClient([
            'keyFilePath' => $config['key_file_path'],
            'projectId' => $config['project_id'],
        ]);
    }

    public function sentiment(string $text): ?array
    {
        return $this->language
            ->analyzeSentiment($text)
            ->sentiment();
    }

    public function entities(string $text): ?array
    {
        return $this->language
            ->analyzeEntities($text)
            ->entities();
    }

    public function entitySentiment(string $text): ?array
    {
        return $this->language
            ->analyzeEntitySentiment($text)
            ->entities();
    }

    public function syntax(string $text): Annotation
    {
        return $this
            ->language
            ->analyzeSyntax($text);
    }

    public function categories(string $text): ?array
    {
        return $this->language
            ->classifyText($text)
            ->categories();
    }

    public function annotateText(string $text, array $features = []): ?Annotation
    {
        return empty($features)
            ? $this->language->annotateText($text)
            : $this->language->annotateText($text, ['features' => $features]);
    }

    /**
     * @throws Exception
     */
    private function checkForInvalidConfiguration(array $config): void
    {
        if (! file_exists($config['key_file_path'])) {
            throw new Exception('The json file does not exist at the given path');
        }

        if ((! is_string($config['project_id'])) || empty($config['project_id'])) {
            throw new Exception('Please set a valid project id');
        }
    }
}
