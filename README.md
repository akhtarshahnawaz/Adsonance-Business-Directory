Adsonance-Business-Directory
============================
Adsonance Business Directory ia a simple directory web application which I built to list local businesses in my area. Interesting thing about this web application is that there is a DIY website builder in this application so that you can associate every listing with a simple website. If you want then you can even link a domain name to this website so that every small business will have it's own website.

Requirements
============

1. Enable PHP Installation to support Bracket Type "[]" array. This is only available in PHP versions 5.5.0 and above


Installation
============

1. Go to "Adsonance-Business-Directory/application/config/database.php"
2. Edit Lines

        $db['default']['username'] = '<YOUR DATABASE USERNAME>';
        $db['default']['password'] = '<YOUR DATABASE PASSWORD>';
        $db['default']['database'] = '<YOUR DATABASE NAME>';				


3. Go to link  "<installation folder>/index.php/install"
4. Fill in Username and Password for managing CRM



Email Setup
============

1. Go to "OctantCRM/application/config/email.php"
2. Edit Lines

		$config['smtp_host'] = '<SMTP HOST>';
		$config['smtp_user'] = '<SMTP USERNAME>';
		$config['smtp_pass'] = '<SMTP PASSWORD>';
