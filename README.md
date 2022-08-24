# Google Tag Manager plugin for Craft CMS

This plugin allows you to configure the "ContainerID" from the control panel 
and inject the GTM tags into the template.

![Screenshot](.readme/plugin-screenshot.png)

## Requirements

This plugin requires Craft CMS 4.0.0 or later. Version 1.x of this plugin supports Craft CMS 3.x.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require la-haute-societe/craft-google-tag-manager

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Google Tag Manager.


## Configuring Google Tag Manager

You can configure the containerID from the Craft Control Panel.


## Using Google Tag Manager

Copy the code below and paste it into your layout as high as possible in the `<head>` section 
of the page:
```
{{ craft.googleTagManager.headSection() }}
```

You must also paste this code immediately after the opening tag `<body>`:
```
{{ craft.googleTagManager.bodySection() }}
```



Brought to you by
<a href="https://www.lahautesociete.com" target="_blank"><br><img src=".readme/logo-lahautesociete.png" height="100" alt="Logo La Haute Société" /></a>
