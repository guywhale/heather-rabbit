<?php

use Robo\Symfony\ConsoleIO;

/**
 * Config file for Robo commands.
 * https://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Write contents to file
     *
     * Put the text contents of a template into a file
     *
     * @param string $file TName of the file.
     * @param string $text Text to put into the file.
     * @param string $success Name of the file to put in success message.
     *
     **/
    private function putTextInFile(string $file, string $text, string $success, ConsoleIO $io)
    {
        if (is_writable($file)) {
            if (!$fp = fopen($file, 'a')) {
                echo "Cannot open file ($file)";
                exit;
            }

            // Write $controllerTemplate to our opened file.
            if (fwrite($fp, $text) === false) {
                echo "Cannot write to file ($file)";
                exit;
            }

            fclose($fp);

            $io->say("$success successfully created.");
        } else {
            $io->say("ERROR: $file is not writable.");
        }
    }

    /**
     * Split CamelCase with hypen and make lowercase
     * Used as view filename in $controllerTemplate.
     */
    private function lowerAndHyphentate(string $name)
    {

        $lowerName = preg_replace('/(?<=\\w)(?=[A-Z])/', "-$1", $name);
        $lowerName = strtolower($lowerName);

        return $lowerName;
    }

    /**
     * Split CamelCase with space for block.json.
     * Used as block name in $jsonTemplate.
     */
    private function spacedName(string $name)
    {
        $spacedName = preg_replace('/(?<=\\w)(?=[A-Z])/', " $1", $name);

        return $spacedName;
    }

    private function makeBlockController(string $name, ConsoleIO $io)
    {
        $lowerName = $this->lowerAndHyphentate($name);
        $blockController = __DIR__ . "/app/controllers/blocks/$name.php";
        $controllerSuccess = "$name.php";

        /**
         * Don't change spacing and indendation of template strings as we want them to
         * appear this way in the file we create.
         */
        $controllerTemplate =
"<?php

namespace Hwale\Controllers;

class $name extends Blocks
{
    // Set view type to '$lowerName';
    protected function setViewFile()
    {
        \$this->viewFile = '$lowerName';
    }

    // Set data specific to view
    protected function setData(\$data = [])
    {
        \$this->data = [];
    }

    /**
     * Makes new instance of current class
     *
     * As the renderCallback in block.json will not accept a 'new Class()' instantiation,
     * we can cheat by using a static init() function that instatiates the class instead.
     *
     * 'Hwale\Controllers\Class::init' can then be used to render the block in block.json.
     */
    public static function init()
    {
        new self();
    }
}
";
        // Create block controller
        fopen($blockController, "w+");
        $this->putTextInFile($blockController, $controllerTemplate, $controllerSuccess, $io);
    }

    private function makeBlockView(string $name, ConsoleIO $io)
    {
        $lowerName = $this->lowerAndHyphentate($name);
        $spacedName = $this->spacedName($name);
        $blockViewDir = __DIR__ . "/views/blocks/$lowerName/";
        $blockView = __DIR__ . "/views/blocks/$lowerName/$lowerName.php";
        $viewSuccess = "$lowerName.php";
        $blockJson = __DIR__ . "/views/blocks/$lowerName/block.json";
        $jsonSuccess = "block.json";
        $viewTemplate =
"<?php

[] = \$data;

?>
<section class=\"block-$lowerName\">
</section>
";
        $jsonTemplate =
"{
    \"\$schema\": \"https://schemas.wp.org/trunk/block.json\",
    \"apiVersion\": 2,
    \"name\": \"acf/$lowerName\",
    \"title\": \"Block - $spacedName\",
    \"description\": \"<ADD DESCRIPTION>.\",
    \"editorStyle\": [ \"file:../../../../../build/index.css\" ],
    \"style\": [ \"file:../../../../../build/index.css\" ],
    \"category\": \"common\",
    \"textdomain\": \"hwale\",
    \"icon\": \"layout\",
    \"keywords\": [\"example\", \"acf\"],
    \"acf\": {
        \"mode\": \"auto\",
        \"renderCallback\": \"Hwale\\\Controllers\\\\{$name}::init\"
    },
    \"supports\": {
        \"align\": true,
        \"alignWide\": true
    },
    \"attributes\": {
        \"align\": {
        \"type\": \"string\",
        \"default\": \"full\"
        }
    }
}
";
        // Make block view directory
        if (!is_dir($blockViewDir)) {
            mkdir($blockViewDir, 0755);
            $io->say("/views/blocks/$lowerName/ directory successfully created.");
        } else {
            $io->say("/views/blocks/$lowerName/ already exists.");
        }

        // Make block view file
        fopen($blockView, "w+");
        $this->putTextInFile($blockView, $viewTemplate, $viewSuccess, $io);

        // Make block view JSON
        fopen($blockJson, "w+");
        $this->putTextInFile($blockJson, $jsonTemplate, $jsonSuccess, $io);
    }

    private function makeController(string $name, string $type, ConsoleIO $io)
    {
        $capitalizedType = ucfirst($type);
        $lowerName = $this->lowerAndHyphentate($name);
        $controller = __DIR__ . "/app/controllers/$type/$name.php";
        $controllerSuccess = "$name.php";

        /**
         * Don't change spacing and indendation of template strings as we want them to
         * appear this way in the file we create.
         */
        $controllerTemplate =
"<?php

namespace Hwale\Controllers;

class $name extends $capitalizedType
{
    // Set view type to '$lowerName';
    protected function setViewFile()
    {
        \$this->viewFile = '$lowerName';
    }

    // Set data specific to view
    protected function setData(\$data = [])
    {
        \$this->data = [];
    }
}
";
        // Create controller
        fopen($controller, "w+");
        $this->putTextInFile($controller, $controllerTemplate, $controllerSuccess, $io);
    }

    private function makeView(string $name, string $type, ConsoleIO $io)
    {
        $typeWithoutS = preg_replace('/\S(?!\S)/', "$1", $type);
        $lowerName = $this->lowerAndHyphentate($name);
        $view = __DIR__ . "/views/$type/$lowerName.php";
        $viewSuccess = "$lowerName.php";
        $viewTemplate =
"<?php

[] = \$data;

?>
<section class=\"$typeWithoutS-$lowerName\">
</section>
";
        // Make view file
        fopen($view, "w+");
        $this->putTextInFile($view, $viewTemplate, $viewSuccess, $io);
    }

    public function makeBlock(ConsoleIO $io, $name)
    {
        if (!$name) {
            $io->say('ERROR: Please supply a block name. Name must use uppercase or upper camelcase e.g. Block or NewBlock');
            exit;
        }

        $spacedName = $this->spacedName($name);

        $this->makeBlockController($name, $io);
        $this->makeBlockView($name, $io);
        $io->yell("Block \"$spacedName\" has now been set up.");
    }

    public function makeComponent(ConsoleIO $io, $name)
    {
        if (!$name) {
            $io->say('ERROR: Please supply a component name. Name must use uppercase or upper camelcase e.g. Component or NewComponent');
            exit;
        }

        $spacedName = $this->spacedName($name);

        $this->makeController($name, 'components', $io);
        $this->makeView($name, 'components', $io);
        $io->yell("Component \"$spacedName\" has now been set up.");
    }

    public function makeLayout(ConsoleIO $io, $name)
    {
        if (!$name) {
            $io->say('ERROR: Please supply a layout name. Name must use uppercase or upper camelcase e.g. Layout or NewLayout');
            exit;
        }

        $spacedName = $this->spacedName($name);

        $this->makeController($name, 'layouts', $io);
        $this->makeView($name, 'layouts', $io);
        $io->yell("Component \"$spacedName\" has now been set up.");
    }
}
