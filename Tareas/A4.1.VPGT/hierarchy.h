#include <iostream>
using namespace std;

class Hierarchy
{
public:
	virtual void doSome()=0;
};

class Child1 : public Hierarchy
{
public:
	void doSome()
	{
		cout<< "soy hijo 1";
	}	
};
class Child2 : public Hierarchy
{
public:
	void doSome()
	{
		cout<< "soy hijo 2";
	}	
};
class Child3 : public Hierarchy
{
public:
	void doSome()
	{
		cout<< "soy hijo 3";
	}	
};