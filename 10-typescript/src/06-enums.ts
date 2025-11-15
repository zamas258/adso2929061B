enum CardinalDirections {
  North = 0,
  East = 1,
  South = 2,
  West = 3
}
class Numbers<T> {
    private items: T[] = [];
    addItem(item: T): void {
        this.items.push(item);
    }
    getItems(): T[] {
        return this.items;
    }
}

const directionNumbers = new Numbers<number>();
directionNumbers.addItem(CardinalDirections.North);
directionNumbers.addItem(CardinalDirections.East);
directionNumbers.addItem(CardinalDirections.South);
directionNumbers.addItem(CardinalDirections.West);
const output06 = document.getElementById('output06');

if(output06) {
    output06.innerHTML = `
        <li><strong>Directions collected</strong></li>
        <ul>${directionNumbers.getItems().map(item => `<li>${item}</li>`).join('')}</ul>`;
}