# vimeo-dowload-direct-file
Projeto que retorna link direto para Download do vimeo 

Uma classe utilitária para fazer downloads de vídeos do player da vimeo (https://player.vimeo.com/video/idVideo), assim pode-se realizar o download por qualquer método desejado.

Segue exemplo:

\
<p>
$video = new Vimeo();
\
echo "Link: " . $video->getVimeoDirectUrl("https://player.vimeo.com/video/97370509");
</p>
\
\
Resultado: 
\
Link: https://gcs-vimeo.akamaized.net/exp=1570501492~acl=%2A%2F270503707.mp4%2A~hmac=afc9d55cefceebf76e7d8284b3f4274eb101b7c56a176cea5538cfdf9a524715/vimeo-prod-skyfire-std-us/01/4474/3/97370509/270503707.mp4
