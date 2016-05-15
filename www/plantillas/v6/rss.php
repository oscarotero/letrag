<?php
defined('OK') or die();

$idioma = LANG == 'gal' ? 'gl' : 'es';
print('<?xml version="1.0" encoding="UTF-8"?>'."\n".'<rss version="2.0">');
?>

	<channel>
		<title>letrag</title>
		<link>http://<?php print($idioma); ?>.letrag.com</link>
		<description>Información tipográfica</description>
		
		<language><?php print($idioma); ?></language>
		<category>Tipografía</category>
		<webMaster>oom@oscarotero.com</webMaster>
		<pubDate><?php print(date('r', time())); ?></pubDate>
		<generator>http://letrag.com</generator>
		
		<?php foreach ($resultado['novas'] as $valor) { ?>
		
		<item>
			<title><?php print($valor[$c_titulo]); ?></title>
			<link>http://<?php print($idioma.'.'.$valor['url']); ?></link>
			
			<description><?php print(htmlspecialchars($valor[$c_texto])); ?></description>
			<author>oom@oscarotero.com</author>
			
			<pubDate><?php print(date('r', $valor['data'])); ?></pubDate>
		</item>
		
		<?php } ?>
		
	</channel>
</rss>