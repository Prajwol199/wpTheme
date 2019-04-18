<?php
//add pencil icon
function rise_business_selective_phone_block(){
   echo get_theme_mod('phone_block');
}

function rise_business_selective_email_block(){
   echo get_theme_mod('email_block');
}

function rise_business_title_work(){
   echo get_theme_mod('title');
}

function rise_business_description_work(){
   echo get_theme_mod('description');
}

function rise_business_founder(){
   echo get_theme_mod('founder');
}

function rise_business_position(){
   echo get_theme_mod('position');
}

function rise_business_subscribe_title(){
   echo get_theme_mod('subscribe_title');
}

function rise_business_subscribe_description(){
   echo get_theme_mod('subscribe_description');
}

function rise_business_service_title(){
   echo get_theme_mod('service_title');
}

function rise_business_title_expert(){
   echo get_theme_mod('title_expert');
}

function rise_business_title_partner(){
   echo get_theme_mod('title_partner');
}

function rise_business_description_partner(){
   echo get_theme_mod('description_partner');
}

function rise_business_news_title(){
   echo get_theme_mod('news_title');
}

function rise_business_footer_description(){
   echo get_theme_mod('footer_description');
}

function rise_business_footer_theme_name(){
   echo get_theme_mod('footer_theme_name');
}


//hide input field
function rise_business_hide_input_field_of_work_section( $control ){
    if ( 'show' === $control->manager->get_setting( 'radio_work' )->value() ) {
        return true;
    } else {
        return false;
    }
}

function rise_business_hide_input_field_of_about_us_section( $control ){
    if ( 'show' === $control->manager->get_setting( 'radio_about_us' )->value() ) {
        return true;
    } else {
        return false;
    }
}

function rise_business_hide_input_field_of_service_section( $control ){
    if ( 'show' === $control->manager->get_setting( 'radio_service' )->value() ) {
        return true;
    } else {
        return false; 
    }
}

function rise_business_hide_input_field_of_expert_section( $control ){
    if ( 'show' === $control->manager->get_setting( 'radio_expert' )->value() ) {
        return true;
    } else {
        return false;
    }
}

function rise_business_hide_input_field_of_subscribe_section( $control ){
    if ( 'show' === $control->manager->get_setting( 'radio_subscribe' )->value() ) {
        return true;
    } else {
        return false;
    }
}

function rise_business_hide_input_field_of_patrner_section( $control ){
    if ( 'show' === $control->manager->get_setting( 'radio_partner' )->value() ) {
        return true;
    } else {
        return false;
    }
}

function rise_business_hide_input_field_of_news_section( $control ){
    if ( 'show' === $control->manager->get_setting( 'radio_news' )->value() ) {
        return true;
    } else {
        return false;
    }
}