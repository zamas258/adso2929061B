// 12 - Utility Types: tipos utilitarios de TypeScript

type Book = {
    title: string;
    author: string;
    year: number;
    available: boolean;
};

type PartialBook = Partial<Book>;
type ReadonlyBook = Readonly<Book>;
type BookPreview = Pick<Book, "title" | "author">;
type BookRecord = Record<string, Book>;

const book: ReadonlyBook = {
    title: "The Great Gatsby",
    author: "F. Scott Fitzgerald",
    year: 1925,
    available: true
};

const preview: BookPreview = { title: book.title, author: book.author };

const output12 = document.getElementById('output12');
if (output12) {
    output12.innerHTML = `
        <li><strong>Title:</strong> ${preview.title}</li>
        <li><strong>Author:</strong> ${preview.author}</li>
    `;
}