<?php

namespace Digilopment\PhpstanWebParser;

class JsonFileAnalyzer {
    private $data;

    public function __construct($jsonFilePath) {
        $json = file_get_contents($jsonFilePath);
        $this->data = json_decode($json, true);
    }

    public function analyzeFiles($searchPath = '') {
        $htmlOutput = '';
        foreach ($this->data['files'] as $path => $file) {
            if (!$this->shouldIncludeFile($path, $searchPath)) {
                continue;
            }

            $htmlOutput .= $this->getHtmlOutputForFile($file, $path);
        }

        return $htmlOutput;
    }

    private function shouldIncludeFile($filePath, $searchPath) {
        return empty($searchPath) || strpos($filePath, $searchPath) !== false;
    }

    private function getHtmlOutputForFile($file, $path) {
	$parts = explode('/', ltrim($path,'/'));
	$current = '';
	$alink = '';
	foreach ($parts as $part) {
	    if($part != '/'){
	    	$current .= '/' . $part;
	    	$alink .= '<a href="?path=' . $current . '">/' . $part . '</a>';
	    }
	}
        $html = '<p><b>Path</b>: <span style="color:red">' . $alink . '</span></p>';
        $html .= '<p>Errors: ' . $file['errors'] . '</p>';
        $html .= '<ul>';
        foreach ($file['messages'] as $message) {
            $html .= '<li>Line <b>(' . $message['line'].')</b> ';
            foreach(['netbeans', 'gedit'] as $editor){
                $html .= '<a href="'.$editor.'.php?path='.$current.'&line='.$message['line'].'" target="_blank"><b>'.$editor.'</b></a> ';
            }
            $html .= ' -> ' . $message['message'] . '</li>';
        }
        $html .= '</ul>';

        return $html;
    }
}


