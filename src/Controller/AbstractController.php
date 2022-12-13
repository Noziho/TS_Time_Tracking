<?php

namespace App\Controller;
abstract class AbstractController
{
    abstract public function index();

    /**
     * @param string $template
     * @param array $data
     * @return void
     * Render function for printing View.
     */
    public static function render(string $template, array $data = []): void
    {
        ob_start();
        require __DIR__ . "/../../View/" . $template . ".html.php";
        $html = ob_get_clean();
        require __DIR__ . "/../../View/base.html.php";
    }

    public static function formIsset(...$inputNames): bool
    {
        foreach ($inputNames as $name) {
            if (!isset($_POST[$name]) || empty($_POST[$name])) {
                return false;
            }
        }
        return true;
    }

    public static function getHMSFormatDisplay(int|float $hours, int|float $minutes, int|float $seconds, string $element, string $text = null): void
    {
        if ($text !== null) {
            if ($hours >= 1) { ?>
                <?= $element ?> <?= $text ?> <?= round($hours) ?>h<?= $element ?><?php
                $minutes = 0;
                $seconds = 0;
            }

            if ($hours < 1 && $seconds < 1) { ?>
                <?= $element ?> <?= $text ?> <?= round($minutes) ?>m<?= $element ?><?php
                $seconds = 0;
            }

            if ($minutes < 1 && $hours < 1) { ?>
                <?= $element ?> <?= $text ?> <?= $seconds ?>s<?= $element ?><?php
                $hours = 0;
                $minutes = 0;
            }
        }
        else {
            if ($hours >= 1) { ?>
                <?= $element ?><?= round($hours) ?>h<?= $element ?><?php
                $minutes = 0;
                $seconds = 0;
            }

            if ($hours < 1 && $seconds < 1) { ?>
                <?= $element ?><?= round($minutes) ?>m<?= $element ?><?php
                $seconds = 0;
            }

            if ($minutes < 1 && $hours < 1) { ?>
                <?= $element ?><?= $seconds ?>s<?= $element ?><?php
                $hours = 0;
                $minutes = 0;
            }
        }


    }

}