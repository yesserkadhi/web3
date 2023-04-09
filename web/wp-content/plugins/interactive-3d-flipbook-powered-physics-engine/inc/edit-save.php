<?php
  namespace iberezansky\fb3d;

  function put_value(&$arr, &$key, &$value, $p=0) {
    $i = strpos($key, '-', $p);
    if($i===false) {
      $arr[substr($key, $p)] = $value;
    }
    else {
      $k = substr($key, $p, $i-$p);
      if(!isset($arr[$k])) {
        $arr[$k] = array();
      }
      put_value($arr[$k], $key, $value, $i+1);
    }
  }

  function cast_type($value, $spec) {
    return sprintf($spec, $value); //sanitize_text_field
  }

  function plane2struct($data, $info) {
    $struct = array();
    foreach($info['base'] as $k=> $i) {
      $data[$k] = isset($data[$k])? $data[$k]: $i['default'];
    }
    foreach($data as $k=> $v) {
      unset($value);
      if(isset($info['base'][$k])) {
        $value = $v=='auto'? $v: cast_type($v, $info['base'][$k]['qualifier']);
      }
      else {
        foreach($info['regs'] as $reg) {
          if(preg_match($reg['pattern'], $k)) {
            $value = $v=='auto'? $v: cast_type(isset($v)? $v: $reg['default'], $reg['qualifier']);
          }
        }
      }
      if(isset($value)) {
        put_value($struct, $k, $value);
      }
    }
    return $struct;
  }

  function array2plane($arr, $pref='') {
    $res = [];
    foreach ($arr as $key => $value) {
      if(is_array($value)) {
        $res = array_merge($res, array2plane($value, $pref.$key.'-'));
      }
      else {
        $res[$pref.$key] = $value;
      }
    }
    return $res;
  }

  function get_post_data($id, $plane) {
    $data = plane2struct($plane, array(
      'base'=> array(
        '3dfb-post-type'=> array('default'=> 'pdf', 'qualifier'=> '%s'),
        '3dfb-post-data-post_ID'=> array('default'=> 0, 'qualifier'=> '%d'),
        '3dfb-post-data-guid'=> array('default'=> '', 'qualifier'=> '%s'),
        '3dfb-post-data-pages_customization'=> array('default'=> 'all', 'qualifier'=> '%s'),
        '3dfb-post-data-pdf_pages'=> array('default'=> 0, 'qualifier'=> '%d'),
        '3dfb-post-thumbnail-type'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-thumbnail-data-post_ID'=> array('default'=> 0, 'qualifier'=> '%d'),
        '3dfb-post-ready_function'=> array('default'=> '', 'qualifier'=> '%s'),
        '3dfb-post-book_style'=> array('default'=> 'volume', 'qualifier'=> '%s'),
        '3dfb-post-book_template'=> array('default'=> 'none', 'qualifier'=> '%s'),
        '3dfb-post-outline'=> array('default'=> '[]', 'qualifier'=> '%s'),

        '3dfb-post-props-height'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-width'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-backgroundColor'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-backgroundImage'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-props-backgroundStyle'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-props-highlightLinks'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-lighting'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-props-gravity'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cachedPages'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-renderInactivePages'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-renderInactivePagesOnMobile'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-renderWhileFlipping'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-pagesForPredicting'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-preloadPages'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-rtl'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-interactiveCorners'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-maxDepth'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-autoPlayDuration'=> array('default'=> 'auto', 'qualifier'=> '%d'),

        '3dfb-post-props-sheet-startVelocity'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-cornerDeviation'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-flexibility'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-flexibleCorner'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-bending'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-wave'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-widthTexels'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-heightTexels'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-sheet-color'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-sheet-side'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-props-sheet-shape'=> array('default'=> 'auto', 'qualifier'=> '%d'),

        '3dfb-post-props-cover-startVelocity'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-flexibility'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-flexibleCorner'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-bending'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-wave'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-widthTexels'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-heightTexels'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-color'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-cover-depth'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-padding'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-binderTexture'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-props-cover-mass'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-cover-side'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-props-cover-shape'=> array('default'=> 'auto', 'qualifier'=> '%d'),

        '3dfb-post-props-page-startVelocity'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-flexibility'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-flexibleCorner'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-bending'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-wave'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-widthTexels'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-heightTexels'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-color'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-props-page-depth'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-mass'=> array('default'=> 'auto', 'qualifier'=> '%f'),
        '3dfb-post-props-page-side'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-props-page-shape'=> array('default'=> 'auto', 'qualifier'=> '%d'),

        '3dfb-post-controlProps-actions-cmdToc-enabled'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdToc-enabledInNarrow'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdToc-active'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdToc-defaultTab'=> array('default'=> 'auto', 'qualifier'=> '%s'),
        '3dfb-post-controlProps-actions-cmdAutoPlay-enabled'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdAutoPlay-enabledInNarrow'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdAutoPlay-active'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdSave-enabled'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdSave-enabledInNarrow'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdPrint-enabled'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdPrint-enabledInNarrow'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdSinglePage-enabled'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdSinglePage-enabledInNarrow'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdSinglePage-active'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-cmdSinglePage-activeForMobile'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-widToolbar-enabled'=> array('default'=> 'auto', 'qualifier'=> '%d'),
        '3dfb-post-controlProps-actions-widToolbar-enabledInNarrow'=> array('default'=> 'auto', 'qualifier'=> '%d'),

        '3dfb-autoThumbnail'=> array('default'=> '', 'qualifier'=> '%s'),
      ),
      'regs'=> array( array(
          'pattern'=> '/3dfb-pages-\d+-page_ID/',
          'qualifier'=> '%d',
          'default'=> 0
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_post_ID/',
          'qualifier'=> '%d',
          'default'=> $id
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_title/',
          'qualifier'=> '%s',
          'default'=> ''
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_source_type/',
          'qualifier'=> '%s',
          'default'=> 'epdf'
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_source_data-post_ID/',
          'qualifier'=> '%d',
          'default'=> 0
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_source_data-guid/',
          'qualifier'=> '%s',
          'default'=> ''
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_source_data-interactive/',
          'qualifier'=> '%d',
          'default'=> 0
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_source_data-number/',
          'qualifier'=> '%d',
          'default'=> 0
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_thumbnail_type/',
          'qualifier'=> '%s',
          'default'=> 'auto'
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_thumbnail_data-post_ID/',
          'qualifier'=> '%s',
          'default'=> ''
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_meta_data-css_layer-css/',
          'qualifier'=> '%s',
          'default'=> ''
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_meta_data-css_layer-html/',
          'qualifier'=> '%s',
          'default'=> ''
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_meta_data-css_layer-js/',
          'qualifier'=> '%s',
          'default'=> ''
        ), array(
          'pattern'=> '/3dfb-pages-\d+-page_number/',
          'qualifier'=> '%d',
          'default'=> ''
      ) )
    ));
    $data['3dfb']['pages'] = isset($data['3dfb']['pages'])? $data['3dfb']['pages']: array();
    return $data;
  }

  function get_auto_thumbnail_url($id) {
    $r = NULL;
    if(file_exists(get_auto_thumbnail_dir().'/'.$id.'.png')) {
      $dir = wp_upload_dir();
      $r = $dir['baseurl'].'/'.POST_ID.'/auto-thumbnails/'.$id.'.png';
    }
    return $r;
  }

  function get_auto_thumbnail_dir() {
    $dir = wp_upload_dir();
    return $dir['basedir'].'/'.POST_ID.'/auto-thumbnails';
  }

  function post_auto_thumbnail_save($id, $b64) {
    $dir = get_auto_thumbnail_dir();
    $fn = $dir.'/'.$id.'.png';
    if($b64!=='') {
      if(!file_exists($dir)) {
        mkdir($dir, 0777, TRUE);
      }
      file_put_contents($fn, base64_decode($b64));
    }
    else if(file_exists($fn)){
      unlink($fn);
    }
  }

  function props_save($id) {
    $autosave = wp_is_post_autosave($id);
    $revision = wp_is_post_revision($id);
    $valid = isset($_POST[PROPS_NONCE_NAME]) && wp_verify_nonce($_POST[PROPS_NONCE_NAME], PROPS_NONCE_ACTION);

    if(!($autosave || $revision || !$valid)) {
      $src = json_decode(isset($_POST['3dfb-data'])? str_replace('&x5c', '\\', str_replace('&x27', '\'', str_replace('&x22', '"', $_POST['3dfb-data']))): '{}', true);
      $data = get_post_data($id, $src? $src: []);
      foreach ($data['3dfb']['post'] as $key => $value) {
        if($key==='outline') {
          update_post_meta($id, META_PREFIX.$key, json_decode($value, true));
        }
        else {
          update_post_meta($id, META_PREFIX.$key, $value);
        }
      }

      $version = get_option(TABLE_NAME.'_version');
      if($version!==DBVERSION) {
        install();
      }

      set_post_pages($id, $data['3dfb']['pages']);

      post_auto_thumbnail_save($id, $data['3dfb']['autoThumbnail']);
    }
  }

  add_action('save_post', '\iberezansky\fb3d\props_save');
?>
