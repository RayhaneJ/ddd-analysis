namespace Wellcome.Database.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class Trips : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.Address",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        Street = c.String(),
                        City = c.String(),
                        Country = c.String(),
                        PostalCode = c.String(),
                        Latitude = c.Double(nullable: false),
                        Longitude = c.Double(nullable: false),
                    })
                .PrimaryKey(t => t.ID);
            
            CreateTable(
                "dbo.HostConfiguration",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        Rooms = c.Int(nullable: false),
                        Beds = c.Int(nullable: false),
                        Bathrooms = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ID);
            
            CreateTable(
                "dbo.Contact",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        FirstName = c.String(),
                        LastName = c.String(),
                        Phone = c.String(),
                        Mail = c.String(),
                    })
                .PrimaryKey(t => t.ID);
            
            CreateTable(
                "dbo.Host",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        Title = c.String(),
                        Description = c.String(),
                        AddressID = c.Int(nullable: false),
                        ContactID = c.Int(nullable: false),
                        ConfigurationID = c.Int(nullable: false),
                        TravelersID = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ID)
                .ForeignKey("dbo.Address", t => t.AddressID, cascadeDelete: true)
                .ForeignKey("dbo.HostConfiguration", t => t.ConfigurationID, cascadeDelete: true)
                .ForeignKey("dbo.Contact", t => t.ContactID, cascadeDelete: true)
                .ForeignKey("dbo.TravelersConfiguration", t => t.TravelersID, cascadeDelete: true)
                .Index(t => t.AddressID)
                .Index(t => t.ContactID)
                .Index(t => t.ConfigurationID)
                .Index(t => t.TravelersID);
            
            CreateTable(
                "dbo.TravelersConfiguration",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        Adults = c.Int(nullable: false),
                        Babies = c.Int(nullable: false),
                        Pets = c.Int(nullable: false),
                        Childs = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ID);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.Host", "TravelersID", "dbo.TravelersConfiguration");
            DropForeignKey("dbo.Host", "ContactID", "dbo.Contact");
            DropForeignKey("dbo.Host", "ConfigurationID", "dbo.HostConfiguration");
            DropForeignKey("dbo.Host", "AddressID", "dbo.Address");
            DropIndex("dbo.Host", new[] { "TravelersID" });
            DropIndex("dbo.Host", new[] { "ConfigurationID" });
            DropIndex("dbo.Host", new[] { "ContactID" });
            DropIndex("dbo.Host", new[] { "AddressID" });
            DropTable("dbo.TravelersConfiguration");
            DropTable("dbo.Host");
            DropTable("dbo.Contact");
            DropTable("dbo.HostConfiguration");
            DropTable("dbo.Address");
        }
    }
}
