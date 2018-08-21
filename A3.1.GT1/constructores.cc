#include <iostream>
#include "gtest/gtest.h"

using namespace std;

class myFixture ::testing::Test
{
public:
	virtual void SetUp{cout<<"SetUP";}
	virtual void TearDown{cout<<"TearDown"}	
};

TEST_F(myFixture,prueba1)
{
	ASSERT_TRUE(true);	
}


