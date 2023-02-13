<?php

/**
 * 
 */
class Ayar
{

	private $ayar_id;
	private $ayar_logo;
	private $ayar_url;
	private $ayar_title;
	private $ayar_description;
	private $ayar_keywords;
	private $ayar_author;
	private $ayar_tel;
	private $ayar_gsm;
	private $ayar_faks;
	private $ayar_mail;
	private $ayar_ilce;
	private $ayar_il;
	private $ayar_adres;
	private $vergi_dairesi;
	private $vds;
	private $ayar_mesai;
	private $ayar_maps;
	private $ayar_analystic;
	private $ayar_zopim;
	private $ayar_facebook;
	private $ayar_twitter;
	private $ayar_google;
	private $ayar_youtube;
	private $ayar_smtphost;
	private $ayar_smtpuser;
	private $ayar_smtppassword;
	private $ayar_smtpport;
	private $ayar_bakim;
	private $kullanici_id;
	private $zaman;
	
	function __construct($ayar_id,$ayar_logo,$ayar_url,$ayar_title,$ayar_description,$ayar_keywords,$ayar_author,$ayar_tel,$ayar_gsm,$ayar_faks,$ayar_mail,$ayar_ilce,$ayar_il,$ayar_adres,$vergi_dairesi,$vds,$ayar_mesai,$ayar_maps,$ayar_analystic,$ayar_zopim,$ayar_facebook,$ayar_twitter,$ayar_google,$ayar_youtube,$ayar_smtphost,$ayar_smtpuser,$ayar_smtppassword,$ayar_smtpport,$ayar_bakim,$kullanici_id,$zaman)
	{
		// code...
		$this->ayar_id = $ayar_id;
		$this->ayar_logo = $ayar_logo;
		$this->ayar_url = $ayar_url;
		$this->ayar_title = $ayar_title;
		$this->ayar_description = $ayar_description;
		$this->ayar_keywords = $ayar_keywords;
		$this->ayar_author = $ayar_author;
		$this->ayar_tel = $ayar_tel;
		$this->ayar_gsm = $ayar_gsm;
		$this->ayar_faks = $ayar_faks;
		$this->ayar_mail = $ayar_mail;
		$this->ayar_ilce = $ayar_ilce;
		$this->ayar_il = $ayar_il;
		$this->ayar_adres = $ayar_adres;
		$this->vergi_dairesi = $vergi_dairesi;
		$this->vds = $vds;
		$this->ayar_mesai = $ayar_mesai;
		$this->ayar_maps = $ayar_maps;
		$this->ayar_analystic = $ayar_analystic;
		$this->ayar_zopim = $ayar_zopim;
		$this->ayar_facebook = $ayar_facebook;
		$this->ayar_twitter = $ayar_twitter;
		$this->ayar_google = $ayar_google;
		$this->ayar_youtube = $ayar_youtube;
		$this->ayar_smtphost = $ayar_smtphost;
		$this->ayar_smtpuser = $ayar_smtpuser;
		$this->ayar_smtppassword = $ayar_smtppassword;
		$this->ayar_smtpport = $ayar_smtpport;
		$this->ayar_bakim = $ayar_bakim;
		$this->kullanici_id = $kullanici_id;
		$this->zaman = $zaman;
	}

	public function set_ayar_id($ayar_id) {
		$this->ayar_id = $ayar_id;
	}

	public function get_ayar_id() {
		return $this->ayar_id;
	}

	public function set_ayar_logo($ayar_logo) {
		$this->ayar_logo = $ayar_logo;
	}

	public function get_ayar_logo() {
		return $this->ayar_logo;
	}

	public function set_ayar_url($ayar_url) {
		$this->ayar_url = $ayar_url;
	}

	public function get_ayar_url() {
		return $this->ayar_url;
	}

	public function set_ayar_title($ayar_title) {
		$this->ayar_title = $ayar_title;
	}

	public function get_ayar_title() {
		return $this->ayar_title;
	}

	public function set_ayar_description($ayar_description) {
		$this->ayar_description = $ayar_description;
	}

	public function get_ayar_description() {
		return $this->ayar_description;
	}

	public function set_ayar_keywords($ayar_keywords) {
		$this->ayar_keywords = $ayar_keywords;
	}

	public function get_ayar_keywords() {
		return $this->ayar_keywords;
	}

	public function set_ayar_author($ayar_author) {
		$this->ayar_author = $ayar_author;
	}

	public function get_ayar_author() {
		return $this->ayar_author;
	}

	public function set_ayar_tel($ayar_tel) {
		$this->ayar_tel = $ayar_tel;
	}

	public function get_ayar_tel() {
		return $this->ayar_tel;
	}

	public function set_ayar_gsm($ayar_gsm) {
		$this->ayar_gsm = $ayar_gsm;
	}

	public function get_ayar_gsm() {
		return $this->ayar_gsm;
	}

	public function set_ayar_faks($ayar_faks) {
		$this->ayar_faks = $ayar_faks;
	}

	public function get_ayar_faks() {
		return $this->ayar_faks;
	}

	public function set_ayar_mail($ayar_mail) {
		$this->ayar_mail = $ayar_mail;
	}

	public function get_ayar_mail() {
		return $this->ayar_mail;
	}

	public function set_ayar_ilce($ayar_ilce) {
		$this->ayar_ilce = $ayar_ilce;
	}

	public function get_ayar_ilce() {
		return $this->ayar_ilce;
	}

	public function set_ayar_il($ayar_il) {
		$this->ayar_il = $ayar_il;
	}

	public function get_ayar_il() {
		return $this->ayar_il;
	}

	public function set_ayar_adres($ayar_adres) {
		$this->ayar_adres = $ayar_adres;
	}

	public function get_ayar_adres() {
		return $this->ayar_adres;
	}

	public function set_vergi_dairesi($vergi_dairesi) {
		$this->vergi_dairesi = $vergi_dairesi;
	}

	public function get_vergi_dairesi() {
		return $this->vergi_dairesi;
	}

	public function set_vds($vds) {
		$this->vds = $vds;
	}

	public function get_vds() {
		return $this->vds;
	}

	public function set_ayar_mesai($ayar_mesai) {
		$this->ayar_mesai = $ayar_mesai;
	}

	public function get_ayar_mesai() {
		return $this->ayar_mesai;
	}

	public function set_ayar_maps($ayar_maps) {
		$this->ayar_maps = $ayar_maps;
	}

	public function get_ayar_maps() {
		return $this->ayar_maps;
	}

	public function set_ayar_analystic($ayar_analystic) {
		$this->ayar_analystic = $ayar_analystic;
	}

	public function get_ayar_analystic() {
		return $this->ayar_analystic;
	}

	public function set_ayar_zopim($ayar_zopim) {
		$this->ayar_zopim = $ayar_zopim;
	}

	public function get_ayar_zopim() {
		return $this->ayar_zopim;
	}

	public function set_ayar_facebook($ayar_facebook) {
		$this->ayar_facebook = $ayar_facebook;
	}

	public function get_ayar_facebook() {
		return $this->ayar_facebook;
	}

	public function set_ayar_twitter($ayar_twitter) {
		$this->ayar_twitter = $ayar_twitter;
	}

	public function get_ayar_twitter() {
		return $this->ayar_twitter;
	}

	public function set_ayar_google($ayar_google) {
		$this->ayar_google = $ayar_google;
	}

	public function get_ayar_google() {
		return $this->ayar_google;
	}

	public function set_ayar_youtube($ayar_youtube) {
		$this->ayar_youtube = $ayar_youtube;
	}

	public function get_ayar_youtube() {
		return $this->ayar_youtube;
	}

	public function set_ayar_smtphost($ayar_smtphost) {
		$this->ayar_smtphost = $ayar_smtphost;
	}

	public function get_ayar_smtphost() {
		return $this->ayar_smtphost;
	}

	public function set_ayar_smtpuser($ayar_smtpuser) {
		$this->ayar_smtpuser = $ayar_smtpuser;
	}

	public function get_ayar_smtpuser() {
		return $this->ayar_smtpuser;
	}

	public function set_ayar_smtppassword($ayar_smtppassword) {
		$this->ayar_smtppassword = $ayar_smtppassword;
	}

	public function get_ayar_smtppassword() {
		return $this->ayar_smtppassword;
	}

	public function set_ayar_smtpport($ayar_smtpport) {
		$this->ayar_smtpport = $ayar_smtpport;
	}

	public function get_ayar_smtpport() {
		return $this->ayar_smtpport;
	}

	public function set_ayar_bakim($ayar_bakim) {
		$this->ayar_bakim = $ayar_bakim;
	}

	public function get_ayar_bakim() {
		return $this->ayar_bakim;
	}

	public function set_kullanici_id($kullanici_id) {
		$this->kullanici_id = $kullanici_id;
	}

	public function get_kullanici_id() {
		return $this->kullanici_id;
	}

	public function set_zaman($zaman) {
		$this->zaman = $zaman;
	}

	public function get_zaman() {
		return $this->zaman;
	}
}?>