<div class="wrap pp-admin-page-wrapper" id="pp-404page-settings">
  <h1>
    <span><?php echo $this->_core->get_plugin_name(); ?></span>
    
  </h1>
    <?php settings_errors(); ?>
    
    <div class="postbox">
      <div class="inside">
                
        <form method="POST" action="options.php">
                      
          <h2><?php _e( 'General', '404page' ); ?></h2>
          <?php settings_fields( '404page_settings' ); ?>
          <?php do_settings_sections( '404page_settings_section' ); ?>
          <div id="pp-settings-advanced">
            <h2><?php _e( 'Advanced', '404page' ); ?></h2>
            <?php do_settings_sections( '404page_settings_section_advanced' ); ?>
          </div>
          <?php submit_button(); ?>
          
        </form>
            
      </div>
    </div>
</div>