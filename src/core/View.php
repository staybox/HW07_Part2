<?php
namespace App\Core;
class View
{
    /**
     * @param string $filename
     * @param array $data
     */
    public function render(string $filename, array $data = [], $currentPage = null)
    {
        if (!empty($data)) {
            extract($data);
        }

        $file = "src/views/" . $filename . ".php";
        if (!file_exists($file)) {
            echo "Нет такого файла";
        }
        require($file);
    }
}
