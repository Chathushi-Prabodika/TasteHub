#include <stdio.h>

int main() {
    int a = 5, b = 10;

    printf("a = %d, b = %d\n", a, b);

    printf("=== Logical Operators ===\n");

    // Logical AND
    printf("(a > 0 && b > 0) : %d\n", (a > 0 && b > 0)); // both true -> 1
    printf("(a > 0 && b < 0) : %d\n", (a > 0 && b < 0)); // one false -> 0

    // Logical OR
    printf("(a > 0 || b < 0) : %d\n", (a > 0 || b < 0)); // one true -> 1
    printf("(a < 0 || b < 0) : %d\n", (a < 0 || b < 0)); // both false -> 0

    // Logical NOT
    printf("!(a > 0) : %d\n", !(a > 0)); // true -> 0
    printf("!(a < 0) : %d\n", !(a < 0)); // false -> 1

    return 0;
}