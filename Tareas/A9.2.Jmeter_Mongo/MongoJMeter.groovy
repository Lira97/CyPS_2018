import com.mongodb.*;

MongoClient cli= new MongoClient("localhost",27017);

DB mydb = cli.getDB("test");

DBCollection nombres = mydb.getCollection("nombres");

BasicDBObject bdbo = new BasicDBObject();
bdbo.append("nombres","Julio");

WriteResult writer = nombres.insert(bdbo,WriteConcern.ACKNOWLEDGED);

if(writer.wasAcknowledged())
  OUT.println("se escribio el objeto en la dbs ");
else
  OUT.println("NO se escribio el objeto  ");

SampleResult.setResponseData(writer.toString().getBytes());

bdbo =new BasicDBObject();
bdbo.append("nombres","Rosita");
BasicDBList bdbl = new BasicDBList();
bdbl.add("876543332");
bdbl.add("876540987");
bdbl.add("123456789");
bdbo.append("telefonos",bdbl);

writer = nombres.insert(bdbo,WriteConcern.ACKNOWLEDGED);
SampleResult.setResponseData(writer.toString().getBytes());

BasicDBObject busqueda = new BasicDBObject("name","Pedro");
DBCursor dbo = nombres.find(busqueda);

StringBuilder s = new StringBuilder();


while(dbo.hasNext())
{
  DBObject res = dbo.next();
  s.append(res.toString());

}
vars.put("resultado",s.toString());
