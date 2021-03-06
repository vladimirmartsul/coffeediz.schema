<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if(!empty($arResult['ERRORS'])):?>
	<?foreach($arResult['ERRORS'] as $arErrors){?>
		<p><?=$arErrors?></p>
	<?}?>
<?else:?>

	<div itemscope itemtype="<?=$arResult['TYPE']?>" <? if($arParams['SHOW'] == "Y") { echo 'style="display: none;"'; } ?> <? if(!empty($arParams['ITEMPROP'])):?>itemprop="<?=$arParams['ITEMPROP'];?>" <?endif?>>

	<?if(!empty($arParams['NAME'])):?>
		<div>
			<b><span itemprop="name"><?=$arParams['NAME']?></span></b>
		</div>
	<?endif?>

	<?if(!empty($arParams['DESCRIPTION'])):?>
		<div>
			 <span itemprop="description"><?=$arParams['DESCRIPTION']?></span>
		</div>
	<?endif?>

	<?if(!empty($arParams['POST_CODE']) or !empty($arParams['COUNTRY']) or !empty($arParams['REGION']) or !empty($arParams['LOCALITY']) or !empty($arParams['ADDRESS'])) { ?>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><?=GetMessage('DRINT_ADDRESS')?>
		 <?if(!empty($arParams['POST_CODE'])):?>
			 <span itemprop="postalCode"><?=$arParams['POST_CODE']?></span>,
		 <?endif?>
		 <?if(!empty($arParams['COUNTRY'])):?>
			 <span itemprop="addressCountry"><?=$arParams['COUNTRY']?></span>,
		 <?endif?>
		 <?if(!empty($arParams['REGION'])):?>
			 <span itemprop="addressRegion"><?=$arParams['REGION']?></span>,
		 <?endif?>
	   <?if(!empty($arParams['LOCALITY'])):?>
		   <span itemprop="addressLocality"><?=$arParams['LOCALITY']?></span>,
	   <?endif?>
	   <?if(!empty($arParams['ADDRESS'])):?>
		  <span itemprop="streetAddress"><?=$arParams['ADDRESS']?></span>
	   <?endif?>
	 </div>
	<? } ?>
	
	<?if(!empty($arParams['PHONE'])) { ?>
	 <div><?=GetMessage('DRINT_PHONE')?>
		 <?foreach($arParams['PHONE'] as $key => $phone){
				if(empty($phone))
					continue;
			 ?>
			 <?if($key != 0) { echo ', '; }?>
			<span itemprop="telephone"><?=$phone?></span>
		 <? } ?>
	 </div>
	<? } ?>
	
	<?if(!empty($arParams['FAX'])) { ?>
		<div><?=GetMessage('DRINT_FAX')?>
			<span itemprop="faxNumber"><?=$arParams['FAX']?></span>
		</div>
	<? } ?>
	
	<?if(!empty($arParams['EMAIL']) and $arParams['TYPE'] == "Organization") { ?>
		<div><?=GetMessage('DRINT_EMAIL')?>
			<?foreach($arParams['EMAIL'] as $key => $email){
				if(empty($email))
					continue;
				?>
				<?if($key != 0) { echo ', '; }?>
				<a itemprop="email" href="mailto:<?=trim($email)?>"><?=$email?></a>
			<? } ?>
		</div>
	<? } ?>

	<?if(!empty($arParams['SITE'])) { ?>
		<div><?=GetMessage('URL_TITLE')?>
			<a href="http://<?=$arParams['SITE']?>" itemprop="url"><?=$arParams['SITE']?></a>
		</div>
	<? } ?>

	<?if(!empty($arParams['LOGO'])) { ?>
		<div>
            <?$APPLICATION->IncludeComponent(
                "coffeediz:schema.org.ImageObject",
                "",
                Array(
                    "CONTENTURL" => $arParams['LOGO'],
                    "NAME" => $arParams['LOGO_NAME'],
                    "CAPTION" => $arParams['LOGO_CAPTION'],
                    "DESCRIPTION" => $arParams['LOGO_DESCRIPTION'],
                    "HEIGHT" => $arParams['LOGO_HEIGHT'],
                    "WIDTH" => $arParams['LOGO_WIDTH'],
                    "TRUMBNAIL_CONTENTURL" => $arParams['LOGO_TRUMBNAIL_CONTENTURL'],
                    "TRUMBNAIL_TYPE" => "N",
                    "REPRESENTATIVEOFPAGE" => "",
                    "PARAM_RATING_SHOW" => "N",
                    "ITEMPROP" => "logo",
                ),
                false,
                array('HIDE_ICONS' => 'Y')
            );?>
		</div>
	<? } ?>

	<?if($arParams['TYPE_2'] == "CivicStructure" or $arParams['TYPE_2'] == "LocalBusiness") { ?>

	<div><?=GetMessage('OPENING_HOURS')?>
		 <?foreach($arParams['OPENING_HOURS_ROBOT'] as $key => $openingHours){
				if(empty($openingHours))
					continue;
			 ?>
			 <?if($key != 0) { echo ', '; }?>
			<time itemprop="openingHours" datetime="<?=$openingHours?>"><?=$arParams['OPENING_HOURS_HUMAN'][$key]?></time>
		 <? } ?>
	</div>
	<? } ?>
	
	<?if($arParams['TYPE_2'] == "LocalBusiness" and !empty($arParams['LATITUDE']) and !empty($arParams['LONGITUDE'])) { ?>
		<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			<meta itemprop="latitude" content="<?=$arParams['LATITUDE']?>" />
			<meta itemprop="longitude" content="<?=$arParams['LONGITUDE']?>" />
		</div>
	<? } ?>

	<?if(!empty($arParams['TAXID']) and $arParams['TYPE'] == "Organization"):?>
		<div><?=GetMessage('TAXID')?>
			 <span itemprop="taxID"><?=$arParams['TAXID']?></span>
		</div>
	<?endif?>

	<?if(!empty($arParams['RATINGVALUE']) and $arParams['PARAM_RATING_SHOW'] == "Y"):?>
		<br/><b><?=GetMessage('RATING')?></b>
	<?$APPLICATION->IncludeComponent(
		"coffeediz:schema.org.AggregateRating",
		"example",
		Array(
			"SHOW" => $arParams['RATING_SHOW'],
			"RATINGVALUE" => $arParams['RATINGVALUE'],
			"RAITINGCOUNT" => $arParams['RAITINGCOUNT'],
			"REVIEWCOUNT" => $arParams['REVIEWCOUNT'],
			"BESTRATING" => $arParams['BESTRATING'],
			"WORSTRATING" => $arParams['WORSTRATING'],
			"ITEMPROP" => "Y"
		),
        false,
        array('HIDE_ICONS' => 'Y')
	);?>
	<?endif?>


	</div>

<?endif?>


