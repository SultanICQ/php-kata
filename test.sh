#!/usr/bin/env bash

php src/TestableGameRunner.php > resultado-actual.txt
diff resultado-actual.txt resultado-esperado.txt &>/dev/null
