#!/bin/bash
MUSER="artbedroom"
MPASS="6MPNWabh6tS5hHKA"
MDB="artbedroom"
 
# Detect paths
MYSQL=$(which mysql)
AWK=$(which awk)
GREP=$(which grep)
 

TABLES=$($MYSQL -u $MUSER -p$MPASS $MDB -e 'show tables' | $AWK '{ print $1}' | $GREP -v '^Tables' )
 
for t in $TABLES
do
	echo "Deleting $t table from $MDB database..."
	$MYSQL -u $MUSER -p$MPASS $MDB -e "drop table $t"
done

mysql -u $MUSER -p$MPASS $MDB < artbedroom.sql