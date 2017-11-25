<?php
  include('configurations 1/Colors1.php');
  class CustomizationManager{
    public $currentConfigName;   // saves the current configuration name
    public $colors;  // an object that stores the colors

    // Load the respective configurations based on configName:
    //  "configurations 1" for Ted's team;
    //  "configurations 2" for Neil's team; or
    //  null for default configurations.
    public function SetTheme($configName){
        $this->LoadColors($configName);
    }

    // Load the colors from the Colors1.php file in the selected configuration.
    // Call this from within SetTheme method.
    public function LoadColors($configName){
        if("configurations 1" == $configName){
            $this->colors = new Colors1();
        }else if("configurations 2" == $configName){
            //config 2 color class instantiation
        }else{
            //for default color class instantiation
        }
    }

    // Call this from within SetTheme method.
    public function LoadImages($configName){

    }

    // Call this from within SetTheme method.
    public function LoadLanguages($configName){

    }
  }
?>
