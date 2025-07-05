# Contact Form Setup - CasinosGourmet

## Overview
This project now includes a secure PHP contact form handler that replaces the previous FormSubmit.co service. The form includes multiple security features and will work on any cPanel hosting environment with PHP support.

## Security Features Implemented

### 1. **Rate Limiting**
- Prevents spam by limiting form submissions to once every 30 seconds per session
- Configurable in `config.php`

### 2. **Math CAPTCHA**
- Simple addition problem that users must solve
- Regenerates on each page load and after errors
- Prevents automated bot submissions

### 3. **Honeypot Field**
- Hidden field that bots typically fill out
- If filled, the form submission is rejected
- Invisible to human users

### 4. **Input Validation & Sanitization**
- All inputs are sanitized using PHP's built-in functions
- Email validation using PHP's FILTER_VALIDATE_EMAIL
- Character limits to prevent abuse
- Required field validation

### 5. **Content Filtering**
- Blocks common spam keywords and patterns
- Prevents script injection attempts
- Filters suspicious URLs and content

### 6. **Security Headers**
- `.htaccess` file includes security headers
- Prevents access to log files
- Enables compression and caching

## Files Added/Modified

### New Files:
- `public/contact-handler.php` - Main form processing script
- `public/config.php` - Configuration file for email and security settings
- `public/.htaccess` - Security headers and server configuration

### Modified Files:
- `src/components/ContactoContent.vue` - Updated to use new PHP handler with CAPTCHA
- `vite.config.js` - Ensures PHP files are copied to build directory

## Deployment Instructions

### 1. **Build the Project**
```bash
npm run build
```

### 2. **Upload to cPanel**
Upload the entire `dist/` directory contents to your cPanel's `public_html` folder (or domain folder).

### 3. **Configuration**
Edit `config.php` on the server if needed:
```php
'email' => [
    'to' => 'your-email@yourdomain.com',  // Change this to your email
    'from' => 'noreply@yourdomain.com',   // Change to your domain
    'subject' => 'Nueva cotización desde CasinosGourmet.cl'
],
```

### 4. **Test the Form**
- Visit your website and test the contact form
- Check that emails are being received
- Verify CAPTCHA is working correctly

### 5. **Monitor Logs** (Optional)
The system creates a `contact_log.txt` file to track successful submissions. Check this periodically to monitor form usage.

## File Permissions
Make sure these files have the correct permissions on your server:
- `contact-handler.php` - 644
- `config.php` - 644
- `.htaccess` - 644

## Troubleshooting

### Form Not Sending Emails
1. Check that your hosting supports PHP mail() function
2. Verify the email addresses in `config.php`
3. Check spam folders
4. Some hosts require using SMTP instead of mail() function

### CAPTCHA Not Working
1. Ensure JavaScript is enabled in the browser
2. Check browser console for any errors
3. Verify the form validation logic

### Rate Limiting Issues
1. Clear browser sessions/cookies
2. Adjust rate limiting in `config.php`
3. Check if sessions are working on your host

## Security Notes

1. **HTTPS**: Always use HTTPS in production (uncomment HTTPS redirect in .htaccess if needed)
2. **Regular Updates**: Keep PHP and server software updated
3. **Log Monitoring**: Regularly check `contact_log.txt` for suspicious activity
4. **Backup**: Regular backups of your website and configuration

## Advanced Configuration

### SMTP Email (Recommended for Production)
If your hosting provider recommends SMTP over mail(), you can modify `contact-handler.php` to use PHPMailer:

1. Install PHPMailer via Composer or download manually
2. Update the email sending section in `contact-handler.php`

### Google reCAPTCHA Integration
For stronger bot protection, consider replacing the math CAPTCHA with Google reCAPTCHA:

1. Get reCAPTCHA keys from Google
2. Add reCAPTCHA script to your HTML
3. Verify reCAPTCHA response in PHP

## Support
For issues related to the contact form functionality, check:
1. Server error logs
2. Browser developer console
3. Network tab for failed requests
4. PHP error reporting (if enabled)
