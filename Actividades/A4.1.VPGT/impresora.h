#include <iostream>

using namespace std;

template<class T>
void print_value(T value)
{
	cout<< value << endl;
}


template<class T, class Q>
void print_tuple(T value,Q second)
{
	cout<< value << endl;
}

