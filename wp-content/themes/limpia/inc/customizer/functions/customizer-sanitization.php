<?php
/**
 * Customizer sanitization functions
 *
 * @package Eris
 */

/**
 * Sanitize checkbox
 */
function eris_sanitize_checkbox( $checkbox ) {
    if ( $checkbox ) {
        $checkbox = 1;
    } else {
        $checkbox = false;
    }
    return $checkbox;
}

/**
 * Sanitize text
 */
function eris_sanitize_text( $text ) {
    return $text;
}

/**
 * Sanitize selection.
 */
function eris_sanitize_select( $selection ) {
    return $selection;
}

/**
 * Sanitize portfolio layout radio inputs
 */
function eris_sanitize_portfolio_layout( $selection ) {
	if ( !in_array( $selection, array( 'shuffle', 'three-columns', 'four-columns' ) ) ) {
		$selection = 'shuffle';
	} else {
		return $selection;
	}
}

/**
 * Sanitize the value of Logo image.
 *
 * @param string $logo_image.
 * @return string $logo_image.
 */
function eris_sanitize_image( $logo_image ) {
    return $logo_image;
}


/**
 * Sanitize portfolio header radio inputs
 */
function eris_sanitize_portfolio_header( $selection ) {
    if ( !in_array( $selection, array( 'none', 'slider', 'headline' ) ) ) {
        $selection = 'none';
    } else {
        return $selection;
    }
}

/**
 * Sanitize colors
 */
function eris_sanitize_color( $hex, $default = '' ) {
    if ( eris_of_validate_hex( $hex ) ) {
        return $hex;
    }
    return $default;
}

function eris_of_validate_hex( $hex ) {
    $hex = trim( $hex );
    /* Strip recognized prefixes. */
    if ( 0 === strpos( $hex, '#' ) ) {
        $hex = substr( $hex, 1 );
    }
    elseif ( 0 === strpos( $hex, '%23' ) ) {
        $hex = substr( $hex, 3 );
    }
    /* Regex match. */
    if ( 0 === preg_match( '/^[0-9a-fA-F]{6}$/', $hex ) ) {
        return false;
    }
    else {
        return true;
    }
}

