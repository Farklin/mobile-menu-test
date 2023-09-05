

// Чанк newPreview.tpl
<div class="news-item">
	<img class="news-item-preview" src="{$preview_image}">
	<div class="news-item-title">{$pagetitle}</div>
	<div class="news-item-text">{$content | truncate : 200}</div>
	<div class="news-item-pubdate">{$publishedon | date : 'd.m.Y'}</div>
</div>


// Вывод в шаблоне 
<div class="page">
	<div class="news">
    {$_modx->runSnippet('!getNews')} 
    </div> 
</div> 

// Сниппет getNews
<?php 
return $modx->runSnippet('pdoResources', 
    [   'parents' => 54, 
        'tpl' => 'newPreview.tpl', 
        'includeContent' => '1', 
        'includeTVs' => 'preview_image', 
        'tvPrefix' => '', 
    ]
);
?> 