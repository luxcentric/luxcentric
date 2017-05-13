<?php
/* 
define shortcodes here 
*/

function one_half( $atts, $content = null ) {
    extract( shortcode_atts( array(
            'last' => ''
        ), $atts ) );

    if ( $last == 'yes') {
        $position = ' last-col cf';
    }
    else {
        $position = '';
    }
 
    return '<div class="m-all t-1of2 d-1of2 col' . $position . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('one_half', 'one_half');

function one_third( $atts, $content = null ) {
    extract(shortcode_atts(array(
            'last' => ''
        ), $atts ) );

    if ( $last == 'yes') {
        $position = ' last-col cf';
    }
    else {
        $position = '';
    }

    return '<div class="m-all t-1of3 d-1of3 col' . $position . '">' . do_shortcode( $content ) . '</div>'; 
}
add_shortcode('one_third', 'one_third');

function two_third( $atts, $content = null ) {
    extract(shortcode_atts(array(
            'last' => ''
        ), $atts ) );

    if ( $last == 'yes') {
        $position = ' last-col cf';
    }
    else {
        $position = '';
    }

    return '<div class="m-all t-2of3 d-2of3 col' . $position . '">' . do_shortcode( $content ) . '</div>'; 
}
add_shortcode('two_third', 'two_third');

function one_quarter( $atts, $content = null ) {
    extract( shortcode_atts( array(
            'last' => ''
        ), $atts ) );
 
    if ( $last == 'yes') {
        $position = ' last-col cf';
    }
    else {
        $position = '';
    }

    return '<div class="m-1of2 t-1of4 d-1of4 col' . $position . '">' . do_shortcode( $content ) . '</div>';  
}
add_shortcode('one_quarter', 'one_quarter');

function three_quarter( $atts, $content = null ) {
    extract( shortcode_atts( array(
            'last' => ''
        ), $atts ) );
 
    if ( $last == 'yes') {
        $position = ' last-col cf';
    }
    else {
        $position = '';
    }
 
    return '<div class="m-all t-3of4 d-3of4 col' . $position . '">' . do_shortcode( $content ) . '</div>'; 
}
add_shortcode('three_quarter', 'three_quarter');

// [row]shortcode[/row]
function row_func($atts, $content = null) {
    extract( shortcode_atts( array(
            'name' => null,
            'bgimage' => null,
            'bgcolor' => 'transparent',
            'bgpos' => 'center',
            'align' => null
        ), $atts ) );

    if ( isset ( $align ) ) {
        $align_str = 'text-align: center;';
    } else {
        $align_str = '';
    }

    if ( $bgcolor == "#fff" ) {
        $txt_color = "#2b3c90";
    } else {
        $txt_color = "#fff";
    }

    $output = '<div class="';

    if ( isset ( $name ) )
        $output .= $name;

    if ( isset ( $bgimage ) ) {
        $imageurl = get_template_directory_uri() . '/' . $bgimage;
        $output .= ' bgimage row cf" style="background-image: url(' . $imageurl . '); background-position: ' . $bgpos . '; padding: 1em 0; ' . $align_str . '">' . do_shortcode( $content ) . '</div>';
    } elseif ( $bgcolor == 'transparent' ) {
        $output .= ' row cf" style="padding: 0; ' . $align_str . '">' . do_shortcode( $content ) . '</div>';
    } else {
        $output .= ' row cf" style="background-color: ' . $bgcolor . '; padding: 1em 0; color: ' . $txt_color . '; ' . $align_str . '">' . do_shortcode( $content ) . '</div>';
    }

    return $output;
}
add_shortcode('row', 'row_func');


// [wrap]shortcode[/wrap]
function wrap_func($atts, $content = null) {
    extract( shortcode_atts( array(
            'name' => null,
            'width' => null,
            'align' => 'center'
        ), $atts ) );

    $output = '<div class="';
    if ( isset ( $name ) )
        $output .= $name;

    if ( isset ( $width ) )
        $output .= ' wrap' . $width . ' cf">' . do_shortcode( $content ) . '</div>'; 
    else {
        if ( $align == 'center' )
            $output .= ' wrap cf" style="margin: 0 auto;">' . do_shortcode( $content ) . '</div>';
        else
            $output .= ' wrap cf">' . do_shortcode( $content ) . '</div>';
    }

    return $output;
}
add_shortcode('wrap', 'wrap_func');

// [cta-btn]shortcode[/cta-btn]
function ctabtn_func($atts, $content = null) {
    extract( shortcode_atts( array(
            'center' => 'yes',
            'color' => 'white',
            'linkurl' => '',
            'target' => null
        ), $atts ) );

    if ( isset( $target ) )
        $target = ' target="_blank"';

    $output = '<div class="' . $color . '-btn-border"><div class="' . $color . '-btn"><a href="' . $linkurl . '"' . $target .'>' . do_shortcode( $content ) . '</a></div></div>';

    if ( $center == 'yes' ) {
        $output2 = '<div style="clear: both; text-align: center;" class="button-wrapper">' . $output . '</div>';
        $output = $output2;
    }

    return $output;
}
add_shortcode('cta-btn', 'ctabtn_func');

function flex_container_func($atts, $content = null) {
    extract( shortcode_atts( array(
        'flex_id' => '',
    ), $atts ) );

    if ( $flex_id == '' ) {
        return '<div class="flex-container">' . do_shortcode( $content ) . '</div>';
    } else {
        return '<div id="' . $flex_id . '" class="flex-container">' . do_shortcode( $content ) . '</div>';        
    }
}    
add_shortcode('flex_container', 'flex_container_func');

function flex_item_func($atts, $content = null) {
    extract( shortcode_atts( array(
        'cols' => '',
        'bgimage' => null,
        'bgcolor' => ''
    ), $atts ) );

    if ( $cols == '' )
        $output = '<div class="flex-item ';
    else
        $output = '<div class="flex-item-' . $cols;

    if ( isset ( $bgimage ) ) {
        $imageurl = get_template_directory_uri() . '/' . $bgimage;
        $output .= ' bgimage" style="background-image: url(' . $imageurl . '); position: relative;">' . do_shortcode( $content ) . '</div>';
    } elseif ( $bgcolor == '' ) {
        $output .= '">' . do_shortcode( $content ) . '</div>';
    } else {
        $output .= '" style="background-color: ' . $bgcolor . '; position: relative;"><div style="padding: 3em 2em">' . do_shortcode( $content ) . '</div></div>';
    }

    return $output;
}    
add_shortcode('flex_item', 'flex_item_func');

function clearthefloat_func() {
    return '<div style="clear:both;"></div>';
}
add_shortcode('clearfloats', 'clearthefloat_func');

?>