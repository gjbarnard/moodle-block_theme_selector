Moodle theme selector (block)
=============================

A block to quickly change themes.  Great for theme developers!

About
=====
 * copyright  &copy; 2015-onwards G J Barnard in respect to modifications of original code:
 *            https://github.com/johntron/moodle-theme-selector-block by John Tron, see:
              https://github.com/johntron/moodle-theme-selector-block/issues/1.
 * author     G J Barnard - http://about.me/gjbarnard and http://moodle.org/user/profile.php?id=442195
 * license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later

Required version of Moodle
==========================
This version works with:

 - Moodle 2.9 version 2015051100.00 (Build: 20150511) and above within the 2.9 branch.
 - Moodle 3.0 version 2015111600.00 (Build: 20151116) and above within the 3.0 branch.
 - Moodle 3.1 version 2016052300.00 (Build: 20160523) and above within the 3.1 branch.
 - Moodle 3.3 version 2016110800.00 (Build: 20161108) and above within the 3.2 branch.
 - Moodle 3.3 version 2017051500.00 (Build: 20170515) and above within the 3.3 branch.
 - Moodle 3.4beta+ version 2017102700.00 (Build: 20171027) and above within the 3.4 branch.
 - Moodle 3.5 version 2018051700.00 (Build: 20180517) and above within the 3.5 branch.
 - Moodle 3.6.1 version 2018120301.00 (Build: 20181205) and above within the 3.6 branch.
 - Moodle 3.7 version 2019052000.00 (Build: 20190520) and above within the 3.7 branch.
 - Moodle 3.8 version 2019111800.00 (Build: 20191118) and above within the 3.8 branch.
 - Moodle 3.9 version 2020061500.00 (Build: 20200615) and above within the 3.9 branch.
 - Moodle 3.10 version 2020110900.00 (Build: 20201109) and above within the 3.10 branch.
 - Moodle 3.11 version 2021051700.00 (Build: 20210517) and above within the 3.11 branch.
 - Moodle 4.0 version 2022041900.00 (Build: 20220419) and above within the 4.0 branch.
 - Moodle 4.1 version 2022112800.00 (Build: 20221128) and above within the 4.1 branch.
 - Moodle 4.2 version 2023042400.00 (Build: 20230424) and above within the 4.2 branch.
 - Moodle 4.3 version 2023100900.00 (Build: 20231009) and above within the 4.3 branch.
 - Moodle 4.4 version 2024042200.00 (Build: 20240422) and above within the 4.4 branch.
 - Moodle 4.5 version 2024100700.00 (Build: 20241007) and above within the 4.5 branch.

Installing Moodle links
-----------------------
Please ensure that your hardware and software complies with 'Requirements' in 'Installing Moodle' on:
 - [Moodle 2.9](https://docs.moodle.org/29/en/Installing_Moodle)
 - [Moodle 3.0](https://docs.moodle.org/30/en/Installing_Moodle)
 - [Moodle 3.1](https://docs.moodle.org/31/en/Installing_Moodle)
 - [Moodle 3.2](https://docs.moodle.org/32/en/Installing_Moodle)
 - [Moodle 3.3](https://docs.moodle.org/33/en/Installing_Moodle)
 - [Moodle 3.4](https://docs.moodle.org/34/en/Installing_Moodle)
 - [Moodle 3.5](https://docs.moodle.org/35/en/Installing_Moodle)
 - [Moodle 3.6](https://docs.moodle.org/36/en/Installing_Moodle)
 - [Moodle 3.7](https://docs.moodle.org/37/en/Installing_Moodle)
 - [Moodle 3.8](https://docs.moodle.org/38/en/Installing_Moodle)
 - [Moodle 3.9](https://docs.moodle.org/39/en/Installing_Moodle)
 - [Moodle 3.10](https://docs.moodle.org/310/en/Installing_Moodle)
 - [Moodle 3.11](https://docs.moodle.org/311/en/Installing_Moodle)
 - [Moodle 4.0](https://docs.moodle.org/400/en/Installing_Moodle)
 - [Moodle 4.1](https://docs.moodle.org/401/en/Installing_Moodle)
 - [Moodle 4.2](https://docs.moodle.org/402/en/Installing_Moodle)
 - [Moodle 4.3](https://docs.moodle.org/403/en/Installing_Moodle)
 - [Moodle 4.4](https://docs.moodle.org/404/en/Installing_Moodle)
 - [Moodle 4.5](https://docs.moodle.org/405/en/Installing_Moodle)

Free Software
=============
The theme selector block is 'free' software under the terms of the GNU GPLv3 License, please see 'COPYING.txt'.

It can be obtained for free from:
https://github.com/gjbarnard/moodle-block_theme_selector

You have all the rights granted to you by the GPLv3 license.  If you are unsure about anything, then the
FAQ - http://www.gnu.org/licenses/gpl-faq.html - is a good place to look.

If you reuse any of the code then I kindly ask that you make reference to the theme.

If you make improvements or bug fixes then I would appreciate if you would send them back to me by forking from
https://github.com/gjbarnard/moodle-block_theme_selector and doing a 'Pull Request' so that the rest of the
Moodle community benefits.

Installation
============
1. Follow Moodle's instructions for installing plugins, see: Installing Moodle links.
2. Turn editing mode on.
3. Go to Site administration -> Plugins -> Blocks -> Theme selector and decide if you want URL switching or not.
   When URL Switching is off only users with the 'moodle/site:config' capability will be able to change themes.
   Theme changes are permenant for all.
   When URL Switching is on everybody can change the theme but it will only be for them.  The set site theme will
   remain as set by a user with 'moodle/site:config' capability.
4. Add the "Theme selector" block wherever you like.
5. The selector will show the current theme as the one selected.

Version Information
===================
See Changes.md

Me
==
G J Barnard MSc. BSc(Hons)(Sndw). MBCS. CEng. CITP. PGCE.

- Moodle profile | [Moodle.org](https://moodle.org/user/profile.php?id=442195)
- @gjbarnard     | [X](https://twitter.com/gjbarnard)
- Web profile    | [About.me](https://about.me/gjbarnard)
- Website        | [Website](https://gjbarnard.co.uk)
