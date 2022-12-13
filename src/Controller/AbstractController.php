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

    public static function getHMSFormatDisplay (int $hours, int $minutes, int $seconds, string $element, string $text = null): void {

        if (null === $text) {
            if ($seconds >= 60) {?>
                <?=$element?><?= $minutes ?> m<?= $element ?><?php
            }
            if ($minutes >=60) {?>
                <?=$element?><?= $hours ?> h<?=$element?><?php
            }
            if ($minutes < 1) {?>
                <?=$element?><?= $seconds ?> s<?=$element?><?php
            }
        }
        else {
            if ($seconds >= 60) {?>
                <?=$element?> <?= $text ?> <?= $minutes ?> m<?= $element ?><?php
            }
            if ($minutes >=60) {?>
                <?=$element?> <?= $text ?> <?= $hours ?> h<?=$element?><?php
            }
            if ($minutes < 1) {?>
                <?=$element?> <?= $text ?> <?= $seconds ?> s<?=$element?><?php
            }
        }
    }

}