<?php

/**
 * Class Vimeo
 * @Autor  Caio Ferreira
 */
class Vimeo
{
    /**
     * @var array Vimeo video quality priority
     */
    public $vimeoQualityPrioritet = ['1080p', '720p', '540p', '360p'];

    /**
     * Get direct URL to Vimeo video file
     *
     * @param string $url to video on Vimeo
     * @return string file URL
     */
    public function getVimeoDirectUrl($url)
    {
        $result = '';
        $videoInfo = $this->getVimeoVideoInfo($url);

        if ($videoInfo && $videoObject = $this->getVimeoQualityVideo($videoInfo->request->files)) {
            $result = $videoObject->url;
        }

        return $result;
    }

    /**
     * Get Vimeo Player ,Video config object
     *
     */
    public function getConfigObjectFromHtml($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);

        if ($ini == 0) {
            return '';
        }

        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

    /**
     * Get Vimeo video info
     *
     * @param string $url to video on Vimeo
     * @return \stdClass|null result
     */
    public function getVimeoVideoInfo($url)
    {
        $videoInfo = null;
        $page = $this->getRemoteContent($url);

        $videoConfigJson = json_decode($page);

        return $videoConfigJson;
    }

    /**
     * Get vimeo video object
     *
     * @param stdClass $files object of Vimeo files
     * @return stdClass Video file object
     */
    public function getVimeoQualityVideo($files)
    {
        $video = null;

        if (count($files->progressive)) {
            $this->vimeoVideoQuality = $files->progressive;
        }

        foreach ( $this->vimeoQualityPrioritet as $k => $quality) {
        	foreach ($this->vimeoVideoQuality as $x => $qualityRemote) {
				if ($qualityRemote->quality == $quality) {
                	$video = $qualityRemote;
                	break;
            	}
            	if ($video){
            		break;
            	}
        	}
        }
        if (!$video) {
            foreach (get_object_vars($this->vimeoVideoQuality) as $file) {
                $video = $file;
                break;
            }
        }

        return $video;
    }

    /**
     * Get remote content by URL
     *
     * @param string $url remote page URL
     * @return string result content
     */
    public function getRemoteContent($url)
    {
        $data = file_get_contents($url);

        return $data;
    }
}

?>
