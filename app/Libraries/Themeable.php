<?php

namespace App\Libraries;

use CodeIgniter\View\View;
use RuntimeException;
use  App\Libraries\Theme;
/**
 * Trait Themeable
 *
 * Provides simple theme functionality to controllers.
 */
trait  Themeable
{
    /**
     * The folder the theme is stored in (within /themes)
     *
     * @var string
     */
    protected $theme = 'Default';

    /**
     * @var View
     */
    protected $renderer;

    protected function render(string $view, array $data = [], ?array $options = null)
    {
       

        $renderer = $this->getRenderer();

        
        $data[] = "";

        return $renderer->setData($data)->render($view, $options, true);
            
    }

    /**
     * Gets a renderer instance pointing to the appropriate
     * theme folder.
     *
     * Note: This should only be called right before use so that
     * the controller has a chance to dynamically update the
     * theme being used.
     *
     * @return mixed|View|null
     */
    protected function getRenderer()
    {
        if ($this->renderer !== null) {
            return $this->renderer;
        }

        Theme::setTheme($this->theme);
        $path = Theme::path();

        if (! is_dir($path)) {
            throw new RuntimeException("`{$this->theme}` is not a valid theme folder.");
        }

        $this->renderer = single_service('renderer', $path);

        return $this->renderer;
    }
}
