{if empty($item->list)}
<div class="empty">No FAQ at this time</div>
{else}
    <a id="top"></a>
    {if count($item->categories) > 1}
        <ul class="nav nav-tabs">
        {foreach from = $item->categories item = 'title' key = 'categoryId' name = "category"}
            <li{if $item->category.alias == $categoryId} class="active"{/if}><a href="{$CURRENT_PAGE_FINAL}{if $categoryId}/{$categoryId}{/if}">{$title|htmlspecialchars}</a></li>
        {/foreach}
        </ul>
    {/if}
    <ol class="faq-questions">
        {foreach from = $item->list item = 'faq'}
            <li>
                <a href="{$CURRENT_PAGE}{if $smarty.server.QUERY_STRING}?{$smarty.server.QUERY_STRING}{/if}#n-{$faq.id}">{$faq.question|htmlspecialchars}</a>
            </li>
        {/foreach}
    </ol>
    {if $item->paginator}{include file="ViewController/list-paginator.tpl"|SMGetTemplate paginator = $item->paginator}{/if}
    {foreach from = $item->list item = 'faq' name="faq"}
    <div class="faq-answer">
        <a id="n-{$faq.id}"></a>
        <h3>{$smarty.foreach.faq.iteration}. {$faq.question|htmlspecialchars}</h3>
        <a class="gotop" href="javascript:window.scrollTo(0,0)"><i class="fa fa-arrow-up"></i></a>
        {$faq.answer}
    </div>
    {/foreach}
    {if $item->paginator}{include file="ViewController/list-paginator.tpl"|SMGetTemplate paginator = $item->paginator}{/if}
{/if}
