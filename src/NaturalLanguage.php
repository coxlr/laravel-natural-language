<?php

namespace Coxlr\NaturalLanguage;

class NaturalLanguage
{
    private NaturalLanguageClient $languageClient;

    public function __construct(NaturalLanguageClient $client)
    {
        $this->languageClient = $client;
    }

    public function sentiment(string $text): array
    {
        $sentiment = $this
            ->languageClient
            ->sentiment($text);

        if (is_null($sentiment)) {
            return [
                'text' => $text,
                'verdict' => null,
                'score' => null,
                'magnitude' => null,
            ];
        }

        $verdict = $this->prepareVerdict($sentiment['score'], $sentiment['magnitude']);

        return [
            'text' => $text,
            'verdict' => $verdict,
            'score' => $sentiment['score'],
            'magnitude' => $sentiment['magnitude'],
        ];
    }

    public function entities(string $text): array
    {
        $entities = $this
            ->languageClient
            ->entities($text);

        return [
            'text' => $text,
            'entities' => $entities,
        ];
    }

    public function entitySentiment(string $text): array
    {
        $entities = $this
            ->languageClient
            ->entitySentiment($text);

        return [
            'text' => $text,
            'entities' => $entities,
        ];
    }

    public function syntax(string $text): array
    {
        $syntax = $this
            ->languageClient
            ->syntax($text);

        return [
            'text' => $text,
            'sentences' => method_exists($syntax, 'sentences') ? $syntax->sentences() : null,
            'tokens' => method_exists($syntax, 'tokens') ? $syntax->tokens() : null,
            'language' => method_exists($syntax, 'language') ? $syntax->language() : null,
        ];
    }

    public function categories(string $text): array
    {
        $categories = $this
            ->languageClient
            ->categories($text);

        return [
            'text' => $text,
            'categories' => $categories,
        ];
    }

    public function annotateText(string $text, array $features = []): array
    {
        $annotation = $this
            ->languageClient
            ->annotateText($text, $features);

        if (is_null($annotation)) {
            return [
                'text' => $text,
                'sentences' => null,
                'tokens' => null,
                'entities' => null,
                'sentiment' => null,
                'categories' => null,
                'language' => null,
            ];
        }

        return [
            'text' => $text,
            'sentences' => method_exists($annotation, 'sentences') ? $annotation->sentences() : null,
            'tokens' => method_exists($annotation, 'tokens') ? $annotation->tokens() : null,
            'entities' => method_exists($annotation, 'entities') ? $annotation->entities() : null,
            'sentiment' => $annotation->sentiment(),
            'categories' => method_exists($annotation, 'categories') ? $annotation->categories() : null,
            'language' => method_exists($annotation, 'language') ? $annotation->language() : null,
        ];
    }

    public function prepareVerdict(float $score, float $magnitude): string
    {
        if (in_array($score, range(-1.0, -0.25, 0.01), true)) {
            if (in_array($magnitude, range(1.0, 100.0, 0.01), true)) {
                return Verdict::VERY_NEGATIVE;
            }

            return Verdict::MOSTLY_NEGATIVE;
        }

        if (in_array($score, range(0.25, 1.0, 0.01), true)) {
            if (in_array($magnitude, range(1.0, 100.0, 0.01), true)) {
                return Verdict::VERY_POSITIVE;
            }

            return Verdict::MOSTLY_POSITIVE;
        }

        return Verdict::MIXED_AND_NEUTRAL;
    }
}
