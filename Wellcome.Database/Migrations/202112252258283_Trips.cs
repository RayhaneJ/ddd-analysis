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
                "dbo.Feedback",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        Notation = c.Int(nullable: false),
                        TimeStamp = c.DateTime(nullable: false),
                        UserId = c.Int(nullable: false),
                        Remark = c.String(),
                    })
                .PrimaryKey(t => t.ID)
                .ForeignKey("dbo.User", t => t.UserId, cascadeDelete: true)
                .Index(t => t.UserId);
            
            CreateTable(
                "dbo.User",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        ContactId = c.Int(nullable: false),
                        Profession = c.String(),
                        Age = c.Int(nullable: false),
                        Gender = c.Int(nullable: false),
                        Password = c.String(),
                    })
                .PrimaryKey(t => t.ID)
                .ForeignKey("dbo.Contact", t => t.ContactId, cascadeDelete: true)
                .Index(t => t.ContactId);
            
            CreateTable(
                "dbo.Host",
                c => new
                    {
                        ID = c.Int(nullable: false, identity: true),
                        Title = c.String(),
                        Description = c.String(),
                        AddressID = c.Int(nullable: false),
                        UserId = c.Int(nullable: false),
                        HostConfigurationID = c.Int(nullable: false),
                        TravelersConfigurationID = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ID)
                .ForeignKey("dbo.Address", t => t.AddressID, cascadeDelete: true)
                .ForeignKey("dbo.HostConfiguration", t => t.HostConfigurationID, cascadeDelete: true)
                .ForeignKey("dbo.TravelersConfiguration", t => t.TravelersConfigurationID, cascadeDelete: true)
                .ForeignKey("dbo.User", t => t.UserId, cascadeDelete: true)
                .Index(t => t.AddressID)
                .Index(t => t.UserId)
                .Index(t => t.HostConfigurationID)
                .Index(t => t.TravelersConfigurationID);
            
            CreateTable(
                "dbo.HostPicture",
                c => new
                    {
                        ID = c.Int(nullable: false),
                        Path = c.String(),
                        HostId = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ID)
                .ForeignKey("dbo.Host", t => t.ID)
                .Index(t => t.ID);
            
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
            
            CreateTable(
                "dbo.ProfilePicture",
                c => new
                    {
                        ID = c.Int(nullable: false),
                        Path = c.String(),
                        UserId = c.Int(nullable: false),
                    })
                .PrimaryKey(t => t.ID)
                .ForeignKey("dbo.User", t => t.ID)
                .Index(t => t.ID);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.ProfilePicture", "ID", "dbo.User");
            DropForeignKey("dbo.Host", "UserId", "dbo.User");
            DropForeignKey("dbo.Host", "TravelersConfigurationID", "dbo.TravelersConfiguration");
            DropForeignKey("dbo.HostPicture", "ID", "dbo.Host");
            DropForeignKey("dbo.Host", "HostConfigurationID", "dbo.HostConfiguration");
            DropForeignKey("dbo.Host", "AddressID", "dbo.Address");
            DropForeignKey("dbo.Feedback", "UserId", "dbo.User");
            DropForeignKey("dbo.User", "ContactId", "dbo.Contact");
            DropIndex("dbo.ProfilePicture", new[] { "ID" });
            DropIndex("dbo.HostPicture", new[] { "ID" });
            DropIndex("dbo.Host", new[] { "TravelersConfigurationID" });
            DropIndex("dbo.Host", new[] { "HostConfigurationID" });
            DropIndex("dbo.Host", new[] { "UserId" });
            DropIndex("dbo.Host", new[] { "AddressID" });
            DropIndex("dbo.User", new[] { "ContactId" });
            DropIndex("dbo.Feedback", new[] { "UserId" });
            DropTable("dbo.ProfilePicture");
            DropTable("dbo.TravelersConfiguration");
            DropTable("dbo.HostPicture");
            DropTable("dbo.Host");
            DropTable("dbo.User");
            DropTable("dbo.Feedback");
            DropTable("dbo.Contact");
            DropTable("dbo.HostConfiguration");
            DropTable("dbo.Address");
        }
    }
}
