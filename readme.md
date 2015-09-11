## Overview of Metapod.

I decided to write metapod, because I was having trouble monitoring some Wordpress sites.
I wanted to know what accounts were making changes to the system, were the admin accounts compromised? Was the FTP compromised? or was there some bad script giving the hackers write access?

Because I had a need for this information, I created 'Watchdog', which is currently a class inside Metapod that monitors the login, and monitors the following PHP pages loading (load-theme-editor.php & load-plugin-editor.php). This information is then written to the log file. I will be expanding this to allow users to log data to files or to a database, as well as defining an interface that users can adhere to that will work alongside the plugin, but that is further down the line. (An API logger, or maybe a new relic one?)

## What does Metapod CURRENTLY do?

* Logs admin logins to a file. ( Date, Username )
* Logs when the plugin or theme editors are loaded, or saved. ( Date, Username, File, Action )

## What do I WANT Metapod to be in the future?

I want Metapod to evolve to become a plugin that enchances Wordpress security. I want it to monitor file permissions, deny brute forcing of logins, and also compare your core wordpress files to the ones hosted on wordpress.org. I feel that these features would be great to have in a single plugin. I have many other ideas for this project too, so it doesn't stop there.

## How do I use Metapod?

* Download the zip, and copy to your plugin directory

## Why is this not hosted on the Wordpress plugin site?

I will host it on the Wordpress plugin site, once I've tested more versions, and added more features.

I would be extremely grateful if people could credit, or even shoot me an email if you're using this plugin. Let me know if it's working for you, or even just a simple thank you. It would be really nice to hear that I am helping people with this tool.

Thank You.