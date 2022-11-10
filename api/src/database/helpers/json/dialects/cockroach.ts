import { Knex } from 'knex';
import { JsonHelperDefault } from './default';

export class JsonHelperCockroachDB extends JsonHelperDefault {
	static isSupported(version: string, _full = ''): boolean {
		if (version === '-') return false;
		const major = parseInt(version.substring(1).split('.')[0]);
		// apparently cockroach DB supports JSON since v2 but not very well
		return major >= 2;
	}
	preProcess(dbQuery: Knex.QueryBuilder, table: string): void {
		dbQuery
			.select(
				this.nodes.map((node) => {
					const { dbType } = this.schema.collections[table].fields[node.name];
					return this.knex.raw(
						dbType === 'jsonb' ? 'jsonb_extract_path(??, ?) as ??' : 'jsonb_extract_path(to_jsonb(??), ?) as ??',
						[`${table}.${node.name}`, node.jsonPath, node.fieldKey]
					);
				})
			)
			.from(table);
	}
}