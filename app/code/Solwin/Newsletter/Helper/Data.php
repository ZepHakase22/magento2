<?php

namespace Solwin\Newsletter\Helper;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Element\Template;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    protected $_storeManager;
    protected $logoblock;
    protected $_config;
    protected $_displayconfigoptions;
    protected $_moreconfigoptions;
    protected $_scopeConfig;

    public function __construct(
    \Magento\Framework\App\Helper\Context $context, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\UrlInterface $urlinterface, \Magento\Theme\Block\Html\Header\Logo $logoblock, \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->logoblock = $logoblock;
        $this->_storeManager = $storeManager;
        $this->_urlinterface = $urlinterface;
        $this->_config = $scopeConfig->getValue('newsletter_settings/general');
        $this->_displayconfigoptions = $scopeConfig->getValue('newsletter_settings/displayoptions');
        $this->_moreconfigoptions = $scopeConfig->getValue('newsletter_settings/moreoptions');
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function getBaseUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
    }

    public function getMediaUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getIsHomePage() {
        return $this->logoblock->isHomePage();
    }

    public function getCurrentUrl() {
        return $this->_urlinterface->getCurrentUrl(); // Give the current url of recently viewed page
    }

    /* get extension enable/disable */

    public function getEnableNewsletterPopup() {
        return $this->_scopeConfig->getValue('newsletter_settings/general/active', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable Main title */

    public function getShownewslettertitle() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/showmaintitle', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get Main title */

    public function getNewslettertitle() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/maintitle', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* enable/disable deefault main title settings */

    public function getDefaultmaintitlesettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/use_default_maintitle_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get main title font size */

    public function getMaintitlefontsize() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/maintitle_fontsize', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get main title font color */

    public function getMaintitletextcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/maintitle_textcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* enable/disable custom message */

    public function getEnablecustommessage() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/enable_custommessage', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get custom message */

    public function getNewslettercustommessage() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/custommessage', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* enable/disable deefault main title settings */

    public function getDefaultmessagesettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/use_default_custommessage_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get custom message font size */

    public function getMessagefontsize() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/custommessage_fontsize', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get custom message font color */

    public function getMessagetextcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/custommessage_textcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get subscribe button text */

    public function getNewsletterbuttontext() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/buttontext', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* enable/disable default button settings */

    public function getDefaultbuttonsettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/use_default_button_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get button background */

    public function getButtonbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/button_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get button background on hover */

    public function getButtonbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/button_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get button text color */

    public function getButtontextcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/button_text_color', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get button text color on hover */

    public function getButtontextcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/button_text_color_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable show once checkbox */

    public function getEnablecheckbox() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/enable_checkbox', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get show once checkbox lebel text */

    public function getCheckboxtext() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/checkbox_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable newsletter image */

    public function getEnablenewsletterimage() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/enable_newsletter_image', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter box image */

    public function getNewsletterimage() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/upload_newsletter_image', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter box image position */

    public function getNewsletterimageposition() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/imageposition', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable newsletter box background image */

    public function getEnableBackgroundimage() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/enable_background_image', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter box background image */

    public function getNewsletterbackgroundimage() {
        return $this->_scopeConfig->getValue('newsletter_settings/displayoptions/upload_newsletter_background_image', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get popup width */

    public function getPopupwidth() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/popupwidth', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get popup height */

    public function getPopupheight() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/popupheight', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get popup padding */

    public function getPopuppadding() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/poppadding', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable popup border */

    public function getEnablepopupborder() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/popup_box_border', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get popup border color */

    public function getPopupbordercolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/boxbordercolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get cookie expire time */

    public function getCookieexptime() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/cookieexptime', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup show once option */

    public function getPopupshowonce() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/showOnce', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup open effect */

    public function getOpeneffect() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/boxopeneffect', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup open speed */

    public function getOpenspeed() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/boxopenspeed', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup open method */

    public function getOpenmethod() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/boxopenmethod', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup close effect */

    public function getCloseeffect() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/boxcloseeffect', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup close speed */

    public function getClosespeed() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/boxclosespeed', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup close method */

    public function getClosemethod() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/boxclosemethod', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get newsletter popup delay */

    public function getPopupdelay() {
        return $this->_scopeConfig->getValue('newsletter_settings/moreoptions/delay', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable social block */

    public function getEnablesocial() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablesocial', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get social block title */

    public function getSocialtitle() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/social_title', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings of social title */

    public function getEnablesocialtitlesettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_socialtitle_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get social title font size */

    public function getSocialtitlefontsize() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/socialtitle_fontsize', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get social title text color */

    public function getSocialtitletextcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/maintitle_textcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable facebook link */

    public function getEnablefacebook() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablefacebook', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get facebook link */

    public function getFacebooklink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/fb_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for facebook icon */

    public function getEnablfbsettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_fb_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get facebook link background */

    public function getFbbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/fb_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get facebook link background on hover */

    public function getFbbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/fb_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get facebook link icon color */

    public function getFbiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/fb_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get facebook link icon color on hover */

    public function getFbiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/fb_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable twitter link */

    public function getEnabletwitter() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enabletwitter', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get twitter link */

    public function getTwitterlink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/twitter_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

     /* get enable/disable default settings for twitter icon */

    public function getEnabltwittersettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_twitter_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get twitter link background */

    public function getTwitterbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/twitter_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get twitter link background on hover */

    public function getTwitterbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/twitter_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get twitter link icon color */

    public function getTwittericoncolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/twitter_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get twitter link icon color on hover */

    public function getTwittericoncolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/twitter_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable googleplus link */

    public function getEnablegplus() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablegoogle', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get googleplus link */

    public function getGpluslink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/google_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for googleplus icon */

    public function getEnablgoogleplussettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_gplus_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get googleplus link background */

    public function getGplusbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/google_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get googleplus link background on hover */

    public function getGplusbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/google_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get googleplus link icon color */

    public function getGplusiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/google_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get googleplus link icon color on hover */

    public function getGplusiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/google_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable youtube link */

    public function getEnableyoutube() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enableyoutube', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get youtube link */

    public function getYoutubelink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/youtube_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for youtube icon */

    public function getEnablyoutubesettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_youtube_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get youtube link background */

    public function getYoutubebackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/youtube_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get youtube link background on hover */

    public function getYoutubebackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/youtube_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get youtube link icon color */

    public function getYoutubeiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/youtube_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get youtube link icon color on hover */

    public function getYoutubeiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/youtube_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable flickr link */

    public function getEnableflickr() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enableflickr', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get flickr link */

    public function getFlickrlink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/flickr_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for flickr icon */

    public function getEnablflickrsettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_flickr_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get flickr link background */

    public function getFlickrbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/flickr_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get flickr link background on hover */

    public function getFlickrbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/flickr_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get flickr link icon color */

    public function getFlickriconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/flickr_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get flickr link icon color on hover */

    public function getFlickriconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/flickr_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable vimeo link */

    public function getEnablevimeo() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablevimeo', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get vimeo link */

    public function getVimeolink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/vimeo_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for vimeo icon */

    public function getEnablvimeosettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_vimeo_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get vimeo link background */

    public function getVimeobackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/vimeo_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get vimeo link background on hover */

    public function getVimeobackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/vimeo_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get vimeo link icon color */

    public function getVimeoiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/vimeo_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get vimeo link icon color on hover */

    public function getVimeoiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/vimeo_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable pinterest link */

    public function getEnablepinterest() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablepinterest', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get pinterest link */

    public function getPinterestlink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/pinterest_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for pinterest icon */

    public function getEnablpinterestsettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_pinterest_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get pinterest link background */

    public function getPinterestbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/pinterest_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get pinterest link background on hover */

    public function getPinterestbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/pinterest_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get pinterest link icon color */

    public function getPinteresticoncolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/pinterest_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get pinterest link icon color on hover */

    public function getPinteresticoncolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/pinterest_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable instagram link */

    public function getEnableinstagram() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enableinstagram', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get instagram link */

    public function getInstagramlink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/instagram_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for instagram icon */

    public function getEnablinstagramsettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_instagram_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get instagram link background */

    public function getInstagrambackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/instagram_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get instagram link background on hover */

    public function getInstagrambackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/instagram_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get instagram link icon color */

    public function getInstagramiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/instagram_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get instagram link icon color on hover */

    public function getInstagramiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/instagram_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable foursquare link */

    public function getEnablefoursquare() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablefoursquare', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get foursquare link */

    public function getFoursquarelink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/foursquare_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for foursquare icon */

    public function getEnablfoursquaresettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_foursquare_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get foursquare link background */

    public function getFoursquarebackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/foursquare_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get foursquare link background on hover */

    public function getFoursquarebackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/foursquare_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get foursquare link icon color */

    public function getFoursquareiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/foursquare_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get foursquare link icon color on hover */

    public function getFoursquareiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/foursquare_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable tumblr link */

    public function getEnabletumblr() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enabletumblr', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get tumblr link */

    public function getTumblrlink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/tumblr_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for tumblr icon */

    public function getEnabltumblrsettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_tumblr_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get tumblr link background */

    public function getTumblrbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/tumblr_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get tumblr link background on hover */

    public function getTumblrbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/tumblr_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get tumblr link icon color */

    public function getTumblriconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/tumblr_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get tumblr link icon color on hover */

    public function getTumblriconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/tumblr_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable rss link */

    public function getEnablerss() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablerss', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get rss link */

    public function getRsslink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/rss_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for rss icon */

    public function getEnablrsssettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_rss_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get rss link background */

    public function getRssbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/rss_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get rss link background on hover */

    public function getRssbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/rss_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get rss link icon color */

    public function getRssiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/rss_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get rss link icon color on hover */

    public function getRssiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/rss_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable email link */

    public function getEnableemail() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/enablemail', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get email link */

    public function getEmaillink() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/mail_link', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get enable/disable default settings for mail icon */

    public function getEnablemailsettings() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/use_default_mail_icon_settings', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get email link background */

    public function getEmailbackground() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/mail_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get email link background on hover */

    public function getEmailbackgroundhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/mail_background_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get email link icon color */

    public function getEmailiconcolor() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/mail_iconcolor', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /* get email link icon color on hover */

    public function getEmailiconcolorhover() {
        return $this->_scopeConfig->getValue('newsletter_settings/socialoptions/mail_iconcolor_hover', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getMoreConfigOptions($val = '') {
        return $this->_moreconfigoptions[$val];
    }

    public function getDisplayConfigOptions($val = '') {
        return $this->_displayconfigoptions[$val];
    }

}
