class TableCsvExporter {
    constructor(table, includeHeaders = true) {
        this.table = table;
        this.rows = Array.from(table.querySelectorAll("tr"));

        if (!includeHeaders && this.rows[0].querySelectorAll("th").length) {
            this.rows.shift();

        }

    }

    convertToCsv() {
        const lines = []
        const numCols = this._findLongestRowLength()

        for (const row of this.rows) {
            let line = "";

            for (let i = 0; i < numCols; i++) {
                if (row.children[i] !== undefined) {
                    line += TableCsvExporter.parseCell(row.children[i])
                }

                line += (i !== (numCols - 1)) ? "," : "";
            }
            lines.push(line);
        }

        return lines.join("\n")
    }

    _findLongestRowLength() {
        return this.rows.reduce((l, row) => row.childElementCount > l ? row.childElementCount : l, 0);
    }

    static parseCell(tableCell) {
        let parsedValue = tableCell.textContent

        //remplacer " par ""
        parsedValue = parsedValue.replace(/"/g, `""`)

        //si il y a des virgules, retour a la ligne ou des guillemets, on fout le tout entre guillemets
        parsedValue = /[",\n]/.test(parsedValue) ? `"${parsedValue}"` : parsedValue;

        return parsedValue
    }
}