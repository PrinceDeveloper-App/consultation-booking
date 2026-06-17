<script>
    var CSRF_TOKEN_NAME = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var CSRF_HASH = '<?php echo $this->security->get_csrf_hash(); ?>';

    // Automatically add CSRF token to all jQuery AJAX requests
    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (settings.type === 'POST' && settings.data) {
                if (typeof settings.data === 'string') {
                    settings.data += '&' + CSRF_TOKEN_NAME + '=' + CSRF_HASH;
                } else if (settings.data instanceof FormData) {
                    settings.data.append(CSRF_TOKEN_NAME, CSRF_HASH);
                }
            } else if (settings.type === 'POST' && !settings.data) {
                settings.data = CSRF_TOKEN_NAME + '=' + CSRF_HASH;
            }
        },
        complete: function(xhr) {
            // Update CSRF token from response cookie after each request (since csrf_regenerate is TRUE)
            var newToken = getCookie('<?php echo $this->config->item("csrf_cookie_name"); ?>');
            if (newToken) {
                CSRF_HASH = newToken;
            }
        }
    });

    function getCookie(name) {
        var value = '; ' + document.cookie;
        var parts = value.split('; ' + name + '=');
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }
</script>
