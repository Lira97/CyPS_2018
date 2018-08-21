#include <iostream>
#include "gtest/gtest.h"

using namespace std;

class Foo{public: void does(){cout<<"HOLA";}};

class myFixture:public ::testing::Test
{
	public:
		static void SetUpTestCase(){value = new Foo;}	
		static void TearDownTestCase(){delete value;}
		virtual void SetUp(){cout<<"SetUp";}
		virtual void TearDown(){cout<<"TearDown";}	
	protected:
		static Foo* value;
};

Foo* myFixture::value=0;

class myEnvironment:public ::testing::Environment
{
	public:	
		virtual void SetUp(){cout<<"EnvSetup "; valor_compartido_global=new Foo;}
		virtual void TearDown(){cout<<"EnvTearD "; delete valor_compartido_global;}
	protected:
		static Foo* valor_compartido_global;
};
Foo* myEnvironment::valor_compartido_global=0;

::testing::Environment* const foo_env =::testing::AddGlobalTestEnvironment(new myEnvironment);

TEST_F(myFixture,prueba1)
{
	value->does();
	ASSERT_TRUE(true);	
}
TEST_F(myFixture,prueba2)
{
	value->does();
	ASSERT_TRUE(true);	
}
TEST(myEnvironment,prueba3)
{
	//valor_compartido_global->does();
	ASSERT_TRUE(true);	
}



