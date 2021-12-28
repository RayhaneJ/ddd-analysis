using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Wellcome.DataModel
{
    [Table("Host")]
    public class Host
    {
        public int ID { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }
        public int AddressID { get; set; }
        public virtual Address Address { get; set; }
        public int UserId { get; set; }
        public virtual User User { get; set; }
        public int HostConfigurationID { get; set; }
        public virtual HostConfiguration Configuration { get; set; }
        public int TravelersConfigurationID { get; set; }
        public virtual TravelersConfiguration Travelers { get; set; }
        public virtual HostPicture HostPicture { get; set; }
        public virtual List<FavoriteHost> FavoriteHosts { get; set; }
    }
}