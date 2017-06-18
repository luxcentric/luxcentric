#!/bin/bash

scss style.scss style.css
cp ./style.css ../css/style.css
cp ./style.css.map ../css/style.css.map
gulp
cp ./style.css ../css/style.min.css

