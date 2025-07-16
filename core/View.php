<?php

class View {
    public static function render(string $name, array $variables = [])
    {
        $viewPath = __DIR__ . "/../views/{$name}.php";
        if (!file_exists($viewPath)) {
            throw new \Error("View file '{$name}.php' not found.");
        }

        extract($variables);
        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        echo self::renderString($content);
    }

    private static function renderString(string $content)
    {
        $standardTags = self::htmlTags();

        preg_match_all(
            '/(?:<([a-zA-Z][a-zA-Z0-9\-]*)\b((?:"[^"]*"|\'[^\']*\'|[^>\/])*\s*)\s*(\/?)>(?:([\s\S]*?)(?=(?:<[a-zA-Z][a-zA-Z0-9\-]*\b|<\/\1>|$)))?)|(<\/([a-zA-Z][a-zA-Z0-9\-]*)>)/', 
            $content, 
            $matches, 
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            $tag = $match[1];
            $attributes = $match[2];
            $selfClosing = $match[3] === '/';
            $innerHtml = $match[4];
            $fullMatch = "<$tag$attributes";

            if($selfClosing) {
                $fullMatch .= '/>';
            } else {
                $fullMatch .= ">$innerHtml</$tag>";
            }

            if (in_array($tag, $standardTags) || isset($match[6])) {
                continue;
            }

            $componentPath = __DIR__ . "/../components/{$tag}.php";
            if (!file_exists($componentPath)) {
                continue;
            }

            ob_start();
            include_once $componentPath;
            
            $params = [];
            preg_match_all('/([a-zA-Z_][a-zA-Z0-9_-]*)="([^"]*)"/', $attributes, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $params[$match[1]] = $match[2];
            }
            
            if(!$selfClosing) {
                $params['innerHtml'] = $innerHtml;
            }
            
            echo View::renderString($tag(...$params));
            $component = ob_get_clean();
            $content = str_replace($fullMatch, $component, $content);
        }

        return $content;
    }

    private static function htmlTags()
    {
        return [
            // Document metadata
            'html', 'head', 'title', 'base', 'link', 'meta', 'style',

            // Sections
            'body', 'section', 'nav', 'article', 'aside', 'header', 'footer', 'main', 'div',

            // Headings
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6',

            // Text content
            'p', 'hr', 'pre', 'blockquote', 'ol', 'ul', 'li', 'dl', 'dt', 'dd',
            'figure', 'figcaption',

            // Inline text semantics
            'a', 'em', 'strong', 'small', 's', 'cite', 'q', 'dfn', 'abbr', 'data', 'time',
            'code', 'var', 'samp', 'kbd', 'sub', 'sup', 'i', 'b', 'u', 'mark', 'ruby',
            'rt', 'rp', 'bdi', 'bdo', 'span', 'br', 'wbr',

            // Edits
            'ins', 'del',

            // Embedded content
            'img', 'iframe', 'embed', 'object', 'param', 'video', 'audio', 'source',
            'track', 'canvas', 'map', 'area', 'svg', 'math',

            // Scripting
            'script', 'noscript', 'template', 'slot',

            // Demarcating edits
            'del', 'ins',

            // Table content
            'table', 'caption', 'colgroup', 'col', 'tbody', 'thead', 'tfoot',
            'tr', 'td', 'th',

            // Forms
            'form', 'fieldset', 'legend', 'label', 'input', 'button', 'select',
            'datalist', 'optgroup', 'option', 'textarea', 'output', 'progress',
            'meter',

            // Interactive elements
            'details', 'summary', 'dialog',

            // Web components / scripting
            'slot', 'template'
        ];
    }
}