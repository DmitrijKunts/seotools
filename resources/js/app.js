require('./bootstrap');

import Alpine from 'alpinejs';
import Clipboard from "@ryangjchandler/alpine-clipboard"
import ApexCharts from 'apexcharts'

Alpine.plugin(Clipboard)

window.Alpine = Alpine;

Alpine.start();
