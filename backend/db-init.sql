drop table if exists document;

create table document (
	uuid text primary key,
	class text not null,
	data text_json default '{}',
	deleted boolean default false
);

drop index if exists document_class;

create index document_class on document (class);
