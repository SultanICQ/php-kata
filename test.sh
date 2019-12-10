#!/usr/bin/env bash

set euxo -pipefail

php src/TestableGameRunner.php > resultado-actual.txt
diff -q resultado-actual.txt resultado-esperado.txt

exit 0