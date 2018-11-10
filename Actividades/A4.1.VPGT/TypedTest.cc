#include "gtest/gtest.h"
#include "hierarchy.h"


template <class T>
class TypedFixture : public ::testing::TestWithParam<T>
{
public:
	void SetUp()
	{
		parent = new T;
	}
	void TearDown()
	{
		delete parent ;
	}
	
	T* parent;
};

typedef ::testing::Types<Child1,Child2,Child3> implementations;

TYPED_TEST_CASE(TypedFixture,implementations);

TYPED_TEST(TypedFixture,implementations)
{
	this->parent->doSome();
}