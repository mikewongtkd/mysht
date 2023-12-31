drop table if exists document;

create table document (
	uuid text primary key,
	class text not null,
	data text_json default '{}',
	deleted text default null,
	created text default current_timestamp,
	modified text default current_timestamp,
	seen text default current_timestamp
);

create table document_group (
	a text not null,
	b text not null,
	class text not null,
	deleted text default null,
	created text default current_timestamp,
	modified text default current_timestamp,
	seen text default current_timestamp,
	primary key (a, b)
);

drop index if exists document_class;

create index document_class on document (class);

drop index if exists document_group_class;

create index document_group_class on document_group (class);

drop index if exists document_group_a;

create index document_group_a on document_group (a);

drop index if exists document_group_b;

create index document_group_b on document_group (b);
