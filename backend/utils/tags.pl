#! /usr/bin/perl

use UUID qw( uuid );

my $tags   = [ @ARGV ];
my $insert = [];

foreach my $tag (sort @$tags) {
	my $uuid = uuid();
	push @$insert, qq|('$uuid', 'tag', '{"label":"$tag"}')|;
}

print join( ', ', @$insert ), "\n\n";
