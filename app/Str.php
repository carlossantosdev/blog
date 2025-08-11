<?php

namespace App;

use League\CommonMark\Node\Node;
use League\CommonMark\Node\Inline\Text;
use Tempest\Highlight\CommonMark\CodeBlockRenderer;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Tempest\Highlight\CommonMark\InlineCodeBlockRenderer;
use League\CommonMark\Node\Inline\AbstractStringContainer;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Image;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;

class Str extends \Illuminate\Support\Str
{
    #[\Override]
    public static function markdown($string, array $options = [], array $extensions = []) : string  // @pest-ignore-type
    {
        $options = array_merge([
            'default_attributes' => [
                // Add an ID to all headings to help with the table of contents.
                Heading::class => [
                    'id' => fn (Heading $heading) => Str::slug(
                        static::childrenToText($heading)
                    ),
                ],
            ],
            // Basic security measure.
            'disallowed_raw_html' => [
                'disallowed_tags' => ['noembed', 'noframes', 'plaintext', 'script', 'style', 'textarea', 'title', 'xmp'],
            ],
            // Open external links in a new window.
            'external_link' => [
                'internal_hosts' => [
                    preg_replace('/https?:\/\//', '', (string) config('app.url')),
                ],
                'open_in_new_window' => true,
            ],
        ], $options);

        $extensions = array_merge([
            new DefaultAttributesExtension,
            new ExternalLinkExtension,
            new SmartPunctExtension,
        ], $extensions);

        $converter = new GithubFlavoredMarkdownConverter($options);

        $environment = $converter
            ->getEnvironment()
            ->addRenderer(FencedCode::class, new CodeBlockRenderer)
            ->addRenderer(Code::class, new InlineCodeBlockRenderer);

        foreach ($extensions as $extension) {
            $environment->addExtension($extension);
        }

        return (string) $converter->convert($string);
    }

    public static function lightdown(string $string, array $options = [], array $extensions = []) : string  // @pest-ignore-type
    {
        $options = array_merge([
            'disallowed_raw_html' => [
                'disallowed_tags' => ['noembed', 'noframes', 'plaintext', 'script', 'style', 'textarea', 'title', 'xmp'],
            ],
            // Open external links in a new window.
            'external_link' => [
                'internal_hosts' => [
                    preg_replace('/https?:\/\//', '', (string) config('app.url')),
                ],
                'open_in_new_window' => true,
            ],
        ], $options);

        $extensions = array_merge([
            new ExternalLinkExtension,
        ], $extensions);

        $converter = new GithubFlavoredMarkdownConverter($options);

        $environment = $converter
            ->getEnvironment()
            ->addRenderer(FencedCode::class, new CodeBlockRenderer)
            ->addRenderer(Code::class, new InlineCodeBlockRenderer)
            ->addRenderer(Image::class, new class implements NodeRendererInterface
            {
                public function render(Node $node, ChildNodeRendererInterface $childRenderer) : string
                {
                    if (! $node instanceof Image) {
                        throw new \InvalidArgumentException('Incompatible node type: ' . $node::class);
                    }

                    // Return only the alt-text (contents of the child nodes), without an <img> tag.
                    return $childRenderer->renderNodes($node->children());
                }
            });

        foreach ($extensions as $extension) {
            $environment->addExtension($extension);
        }

        return (string) $converter->convert($string);
    }

    /**
     * This is a recursive method that will traverse the given
     * node and all of its children to get the text content.
     */
    protected static function childrenToText(Node $node) : string
    {
        return implode('', array_map(function (Node $child): string {
            if ($child instanceof AbstractStringContainer) {
                return $child->getLiteral();
            }

            return static::childrenToText($child);
        }, iterator_to_array($node->children())));
    }
}
