using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;
using Wellcome.DataModel;

namespace Wellcome.Database
{
    public class WellcomeContext : DbContext
    {
        public DbSet<Host> Hosts { get; set; }
        public DbSet<Address> Addresses { get; set; }
        public DbSet<Contact> Contacts { get; set; }
        public DbSet<Configuration> Configurations { get; set; }
        public DbSet<Travelers> Travelers { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
        }
    }
}