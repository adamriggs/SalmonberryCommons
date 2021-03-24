WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-02-01 20:39:58

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.2.1
- Server software: Apache/2.2.34 (Unix) mod_wsgi/3.5 Python/2.7.13 PHP/7.2.1 mod_ssl/2.2.34 OpenSSL/1.0.2j DAV/2 mod_fastcgi/2.4.6 mod_perl/2.0.9 Perl/v5.24.0

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2021/02/Fresh-Pasta-Radiatore.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2021/02/Fresh-Pasta-Radiatore.jpg.webp
- log-call-arguments: true
- converters: (array of 10 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- encoding: "auto"
- metadata: "none"
- near-lossless: 60
- quality: 70
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2021/02/Fresh-Pasta-Radiatore.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/uploads/2021/02/Fresh-Pasta-Radiatore.jpg.webp
- encoding: "auto"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- near-lossless: 60
- quality: 70
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- alpha-quality: 85
- auto-filter: false
- default-quality: 75
- max-quality: 85
- preset: "none"
- size-in-percentage: null (not set)
- skip: false
- rel-path-to-precompiled-binaries: *****
- try-cwebp: true
- try-discovering-cwebp: true
------------

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (the cwebp binary was not found at path: cwebp, or it had missing library dependencies)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Darwin)... We do.
Found 1 binaries: 
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15
Detecting versions of the cwebp binaries found
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-110-mac-10_15 -version 2>&1. Result: *Exec failed*. Permission denied (user: "adam" does not have permission to execute that binary)

**Error: ** **No cwebp binaries could be executed (permission denied for user: "adam").** 
No cwebp binaries could be executed (permission denied for user: "adam").
cwebp failed in 83 ms

*Trying: vips* 

**Error: ** **Required Vips extension is not available.** 
Required Vips extension is not available.
vips failed in 1 ms

*Trying: imagemagick* 

**Error: ** **imagemagick is not installed (cannot execute: "convert")** 
imagemagick is not installed (cannot execute: "convert")
imagemagick failed in 5 ms

*Trying: graphicsmagick* 

**Error: ** **gmagick is not installed** 
gmagick is not installed
graphicsmagick failed in 5 ms

*Trying: ffmpeg* 

**Error: ** **ffmpeg is not installed (cannot execute: "ffmpeg")** 
ffmpeg is not installed (cannot execute: "ffmpeg")
ffmpeg failed in 5 ms

*Trying: wpc* 

**Error: ** **Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.** 
Missing URL. You must install Webp Convert Cloud Service on a server, or the WebP Express plugin for Wordpress - and supply the url.
wpc failed in 3 ms

*Trying: ewww* 

**Error: ** **Missing API key.** 
Missing API key.
ewww failed in 2 ms

*Trying: imagick* 

**Error: ** **Required iMagick extension is not available.** 
Required iMagick extension is not available.
imagick failed in 1 ms

*Trying: gmagick* 

**Error: ** **Required Gmagick extension is not available.** 
Required Gmagick extension is not available.
gmagick failed in 1 ms

*Trying: gd* 

**Error: ** **Gd has been compiled without webp support.** 
Gd has been compiled without webp support.
gd failed in 1 ms

Stack failed in 108 ms

**Error: ** **None of the converters in the stack are operational** 
